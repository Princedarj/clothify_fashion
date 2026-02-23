<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{

public function dashboard()
{
    // ===== BASIC COUNTS =====
    $totalOrders = Order::count();
    $totalUsers = User::where('role', 'user')->count();
    $totalProducts = Product::count();

    $pendingOrders = Order::where('status', 'Pending')->count();
    $deliveredOrders = Order::where('status', 'Delivered')->count();

    // ===== TOTAL REVENUE (Delivered Only) =====
    $totalRevenue = Order::where('status', 'Delivered')
        ->sum('total_amount');

    // ===== DATE RANGES =====
    $currentMonthStart = Carbon::now()->startOfMonth();
    $currentMonthEnd   = Carbon::now()->endOfMonth();

    $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
    $lastMonthEnd   = Carbon::now()->subMonth()->endOfMonth();

    // ===== THIS MONTH REVENUE =====
$currentMonthRevenue = Order::where('status', 'Delivered')
    ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
    ->sum('total_amount');

    // ===== LAST MONTH REVENUE =====
    $lastMonthRevenue = Order::where('status', 'Delivered')
        ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
        ->sum('total_amount');

    // ===== GROWTH PERCENTAGE =====
    if ($lastMonthRevenue > 0) {
        $growthPercentage = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
    } elseif ($currentMonthRevenue > 0) {
        $growthPercentage = 100;   // New revenue after zero month
    } else {
        $growthPercentage = 0;
    }

    $growthPercentage = round($growthPercentage, 2);

    if ($lastMonthRevenue > 0) {
        $growthPercentage = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
    } else {
        $growthPercentage = 0;
    }

    // ===== LAST 6 MONTH SALES (Properly Ordered) =====
    $monthlySales = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
            DB::raw("SUM(total_amount) as total"),
            DB::raw("MIN(created_at) as sort_date")
        )
        ->where('status', 'Delivered')
        ->groupBy('month')
        ->orderBy('sort_date', 'asc')
        ->take(6)
        ->get()
        ->sortBy('sort_date')
        ->pluck('total', 'month');

    // ===== RECENT ORDERS =====
    $recentOrders = Order::with('user')
        ->latest()
        ->take(5)
        ->get();

    //dd($currentMonthRevenue, $lastMonthRevenue);

    return view('admin.dashboard', compact(
        'totalOrders',
        'totalUsers',
        'totalProducts',
        'pendingOrders',
        'deliveredOrders',
        'totalRevenue',
        'growthPercentage',
        'monthlySales',
        'recentOrders'
    ));
}
    

    public function orders(Request $request)
{
    $query = Order::with('user');

    // 🔎 Search
    if ($request->search) {
        $query->where('id', $request->search)
              ->orWhereHas('user', function ($q) use ($request) {
                  $q->where('name', 'like', '%' . $request->search . '%');
              });
    }

    // 📌 Status Filter
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // 🔄 Sorting
    $sort = $request->sort ?? 'id';
    $direction = $request->direction ?? 'asc';

    $orders = $query->orderBy($sort, $direction)->paginate(10)->withQueryString();

    return view('admin.orders', compact('orders'));
}


public function export()
{
    $orders = Order::with('user')->orderBy('id','asc')->get();

    $filename = "orders.csv";

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
    ];

    $callback = function() use ($orders) {
        $file = fopen('php://output', 'w');
        fputcsv($file, ['ID', 'Customer', 'Total', 'Status', 'Date']);

        foreach ($orders as $order) {
            fputcsv($file, [
                $order->id,
                $order->user->name ?? 'Guest',
                $order->total_amount,
                $order->status,
                $order->created_at,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

 
public function users()
{
    $users = User::where('role', 'user')->count();
    return view('admin.users', compact('users'));
}
}                                                   
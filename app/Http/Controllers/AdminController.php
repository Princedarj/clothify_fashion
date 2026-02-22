<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalproducts = Product::count();
        $totalRevenue = Order::sum('total_amount');
        $pendingOrders = Order::where('status', 'Pending')->count();

        // Monthly Revenue (group by month)
        $monthlySales = Order::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("SUM(total_amount) as total")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Recent Orders
        $recentOrders = Order::latest()->take(5)->get();

       return view('admin.dashboard', compact(
                    'recentOrders',
                    'totalOrders',
                    'totalRevenue',
                    'totalUsers',
                    'pendingOrders',
                    'monthlySales',
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
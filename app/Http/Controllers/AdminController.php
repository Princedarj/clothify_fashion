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

        // ===== TOTAL REVENUE =====
        $totalRevenue = Order::where('status', 'Delivered')
            ->sum('grand_total');

        // ===== LAST 6 MONTH SALES =====
        $monthlySalesCollection = Order::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw("SUM(grand_total) as total"),
                DB::raw("MIN(created_at) as sort_date")
            )
            ->where('status', 'Delivered')
            ->where('created_at', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('month')
            ->orderBy('sort_date', 'asc')
            ->get();

        // ===== CONVERT FOR CHART =====
        $monthlySales = $monthlySalesCollection->pluck('total', 'month');

        // ===== PRO GROWTH CALCULATION (MATCHES GRAPH) =====
        $months = $monthlySalesCollection->pluck('total')->values();

        $current = $months->last();
        $last = $months->slice(-2, 1)->first();

        if ($last > 0) {
            $growthPercentage = (($current - $last) / $last) * 100;
        } else {
            $growthPercentage = 0;
        }

        $growthPercentage = round($growthPercentage, 2);

       // Cap growth at 100% for display purposes
        // if ($growthPercentage > 100) {
        //     $growthPercentage = 100;
        // }

        // ===== RECENT ORDERS =====
        $recentOrders = Order::with('user')
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalUsers',
            'totalProducts',
            'pendingOrders',
            'deliveredOrders',
            'totalRevenue',
            'growthPercentage',
            'monthlySales',
            'recentOrders',
        ));
    }

    // ===== ORDERS PAGE =====
    public function orders(Request $request)
    {
        $query = Order::with('user');

        if ($request->search) {
            $query->where('id', $request->search)
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $sort = $request->sort ?? 'id';
        $direction = $request->direction ?? 'asc';

        $orders = $query->orderBy($sort, $direction)
            ->paginate(20)
            ->withQueryString();

        return view('admin.orders', compact('orders'));
    }

    // ===== EXPORT CSV =====
    public function export()
    {
        $orders = Order::with('user')->orderBy('id', 'asc')->get();

        $filename = "orders.csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Customer', 'Total', 'Status', 'Date']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->user->name ?? 'Guest',
                    $order->grand_total,
                    $order->status,
                    $order->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ===== USERS PAGE =====
    public function users()
    {
        $users = User::where('role', 'user')->count();
        return view('admin.users', compact('users'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
        ]);

        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('admins', 'public');
            $user->image = $path;
            $user->save();
        }

        return back()->with('success', 'Profile updated successfully!');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'password' => bcrypt($request->password),
            'role' => 'admin',
            'is_admin' => 1,
        ]);

        return redirect()->route('admin.profile')
            ->with('success', 'Admin created successfully!');
    }
}
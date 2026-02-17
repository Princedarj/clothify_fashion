<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $totalUsers = User::count();
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
    

    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

 
public function users()
{
    $users = User::latest()->paginate(10);
    return view('admin.users', compact('users'));
}
}                                                   
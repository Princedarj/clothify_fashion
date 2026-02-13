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
        $totalRevenue = Order::sum('amount');
        $pendingOrders = Order::where('status', 'Pending')->count();

        // Monthly Revenue (group by month)
        $monthlySales = Order::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("SUM(total_amount) as total")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalUsers',
            'totalRevenue',
            'pendingOrders',
            'monthlySales'
        ));
    }
}                                                   
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function deliver($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Delivered';
        $order->save();

        return back();
    }

    

public function myOrders()
{
    $orders = Order::where('email', Auth::user()->email)
        ->latest()
        ->get();

    return view('orders.my', compact('orders'));
}

}

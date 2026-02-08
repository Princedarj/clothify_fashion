<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;

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
    $orders = Order::where('user_id', auth()->id())->latest()->get();
    return view('orders.my', compact('orders'));
}

public function place(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    Order::create([
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone ?? 'N/A',
        'address' => Auth::user()->address ?? 'N/A',
        'total_amount' => $total,
        'status' => 'Pending',
    ]);

    session()->forget('cart');

    return redirect()
        ->route('order.success')
        ->with('success', 'Your order has been placed successfully 🎉');
}

}

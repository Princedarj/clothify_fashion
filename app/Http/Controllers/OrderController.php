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

    Order::create([
        'user_id' => auth()->id(),
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => '9999999999',
        'address' => 'Test Address',
        'total_amount' => 1000,
        'status' => 'Pending',
    ]);

    session()->forget('cart');

    return back()->with('success', 'Order saved test ✅');
}

}

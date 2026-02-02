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
public function place()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.view');
    }

    // Save order (simple version)
    foreach ($cart as $item) {
        \DB::table('orders')->insert([
            'user_id' => auth()->id(),
            'product_name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Clear cart
    session()->forget('cart');

    return view('checkout.success');
}


}

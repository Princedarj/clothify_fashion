<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
class CheckoutController extends Controller
{
     // Store the checkout data

public function store(Request $request)
{
    $cart = session('cart', []);
    $totalAmount = 0;

    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // 1️⃣ Save order
    $order = Order::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'total_amount' => $totalAmount
    ]);

    // 2️⃣ Save order items
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'total' => $item['price'] * $item['quantity']
        ]);
    }

    // 3️⃣ Clear cart
    session()->forget('cart');

    return redirect()->route('order.success');
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = session('cart', []);

        $subtotal = 0;

        // ✅ Calculate subtotal
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // ✅ Calculate tax (18%)
        $tax = $subtotal * 0.18;

        // ✅ Grand total
        $grandTotal = $subtotal + $tax;

        // 1️⃣ Save order
        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,

            // ✅ NEW FIELDS
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total_amount' => $grandTotal
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
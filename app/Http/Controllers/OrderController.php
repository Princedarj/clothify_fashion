<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;


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
    $orders = Order::where('user_id', auth()->user()->id)
        ->with('items')
        ->latest()
        ->get();

    return view('orders.my', compact('orders'));
}



public function place(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required',
        'pincode' => 'required',
    ]);

    $cart = session()->get('cart', []);


    if (empty($cart)) {
        return redirect()->route('cart.index');
    }

    // ✅ Calculate total
    $totalAmount = 0;
    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // ✅ Create order
    $order = Order::create([
        'user_id' => Auth::id(),
        'name'         => $request->name,
        'email'        => $request->email,
        'phone'        => $request->phone,
        'address'      => $request->address,
        'pincode'      => $request->pincode,
        'total_amount' => $totalAmount,
        'status'       => 'Pending',
    ]);

    // ✅ Save order items
    foreach ($cart as $item) {
        OrderItem::create([
            'order_id'     => $order->id,
            'product_name' => $item['name'],
            'price'        => $item['price'],
            'quantity'     => $item['quantity'],
            'total'        => $item['price'] * $item['quantity'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('order.success', $order->id);

}


public function show($id)
{
    $order = Order::with('items')->findOrFail($id);

    return view('admin.order-details', compact('order'));
}

public function invoice($id)
{
    $order = Order::with('items')->findOrFail($id);

    $pdf = Pdf::loadView('admin.invoice', compact('order'));

    return $pdf->download('invoice-order-'.$order->id.'.pdf');
}



public function userInvoice($id)
{
    $order = Order::with('items')
        ->where('id', $id)
        ->where('user_id', Auth::id()) // 🔐 security check
        ->firstOrFail();

    $pdf = Pdf::loadView('admin.invoice', compact('order'));

    return $pdf->download('invoice-order-'.$order->id.'.pdf');
}


public function success($id)
{
    $order = Order::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    return view('orders.success', compact('order'));
}


}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class OrderController extends Controller
{

// ✅ ADMIN VIEW ALL ORDERS
    public function index()
    {
        $orders = \App\Models\Order::query()
            ->reorder()
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('admin.orders', compact('orders'));
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN MARK ORDER AS DELIVERED
    public function deliver($id)
    {

        $order = Order::findOrFail($id);
        $order->status = 'Delivered';
        $order->delivered_at = now();
        $order->save();

        return back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    // ✅ USER VIEW MY ORDERS
public function myOrders()
{
    $orders = Order::where('user_id', auth()->user()->id)
        ->with('items')
        ->latest()
        ->get();

    return view('orders.my', compact('orders'));
}

/////////////////////////////////////////////////////////////////////////////////////////////

/// ✅ PLACE ORDER
public function place(Request $request)
{
    App::setLocale(auth()->user()->language ?? 'en');
    
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
        'grand_total'  => $grand_total = $totalAmount * 1.18, // total + 18% tax 
        'subtotal'     => $totalAmount,
        'tax'          => $totalAmount * 0.18, // 18%
        // 'status'       => 'Pending',
        'status' => __('messages.Pending'),
    ]);

    // ✅ Save order items
    foreach ($cart as $item) {
    OrderItem::create([
        'order_id'     => $order->id,
        'product_name' => $item['name'] ?? 'Unknown Product',
        'price'        => $item['price'] ?? 0,
        'quantity'     => $item['quantity'] ?? 1,
        'total'        => ($item['price'] ?? 0) * ($item['quantity'] ?? 1),
    ]);
    }
        $order->load('items.product', 'user');
        App::setLocale(auth()->user()->language ?? 'en');
        $order = Order::with('items.product')->find($order->id);
        Mail::to($order->email)->send(new OrderPlacedMail($order));
        

    session()->forget('cart');

    //return redirect()->route('order.success', $order->id);
    return redirect()
    ->route('order.success', $order->id)
    ->with('success', __('messages.Order Placed Successfully'));

}

/////////////////////////////////////////////////////////////////////////////////////////////

// ✅ ADMIN VIEW ORDER DETAILS
public function show($id)
{
    $order = Order::with('items')->findOrFail($id);

    return view('admin.order-details', compact('order'));
}

/////////////////////////////////////////////////////////////////////////////////////////////

// ✅ ADMIN INVOICE DOWNLOAD
public function invoice($id)
{
    $order = Order::with('items')->findOrFail($id);

    $subtotal = $order->items->sum('total');
    $tax = $subtotal * 0.18; // 18% GST
    $grandTotal = $subtotal + $tax;

    $pdf = Pdf::loadView('admin.invoice', compact(
        'order',
        'subtotal',
        'tax',
        'grandTotal'
    ));

    return $pdf->download('invoice-'.$order->id.'.pdf');
}

//////////////////////////////////////////////////////////////////////////////////////////////

/// ✅ USER INVOICE DOWNLOAD
public function userInvoice($id)
{
    $order = Order::with('items')
        ->where('id', $id)
        ->where('user_id', Auth::id()) // 🔐 security check
        ->firstOrFail();

    $pdf = Pdf::loadView('admin.invoice', compact('order'));

    return $pdf->download('invoice-order-'.$order->id.'.pdf');
}

/////////////////////////////////////////////////////////////////////////////////////////////

// ✅ ORDER SUCCESS PAGE
public function success($id)
{
    $order = Order::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

        $order->load('items.product');

    return view('orders.success', compact('order'));
}

////////////////////////////////////////////////////////////////////////////////////////////

// ✅ ADMIN DASHBOARD WITH STATS & RECENT ORDERS
public function adminDashboard()
{
    $totalOrders = Order::count();

    $totalRevenue = Order::where('status', 'Delivered')
        ->sum('total_amount');

    $totalUsers = \App\Models\User::count();

    $pendingOrders = Order::where('status', 'Pending')->count();

    $monthlySales = Order::select(
            DB::raw("MONTH(created_at) as month"),
            DB::raw("SUM(total_amount) as total")
        )
        ->where('status', 'Delivered')
        ->groupBy(DB::raw("MONTH(created_at)"))
        ->pluck('total', 'month');

    // ✅ ADD THIS
    $recentOrders = Order::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalOrders',
        'totalRevenue',
        'totalUsers',
        'pendingOrders',
        'monthlySales',
        'recentOrders' // add here
    ));
}

///////////////////////////////////////////////////////////////////////////////////////////////////////

// ✅ ADMIN ORDERS WITH SEARCH & FILTER
public function adminOrders(Request $request)
{
    $query = Order::query();

    // Search by customer name
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by date
    if ($request->filled('date')) {
        if ($request->date == 'today') {
            $query->whereDate('created_at', now());
        } elseif ($request->date == 'month') {
            $query->whereMonth('created_at', now()->month);
        }
    }

    $orders = Order::query()
    ->reorder()
    ->orderBy('id', 'asc')
    ->paginate(10);

    return view('admin.orders', compact('orders'));
}   

//////////////////////////////////////////////////////////////////////////////////////////////

// ✅ EXPORT ORDERS TO EXCEL
public function export(Request $request)
{
    $query = Order::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $orders = $query->latest()->get();

    return Excel::download(new OrdersExport($orders), 'orders.xlsx');
}

public function buyNow($id)
{
    $product = \App\Models\Product::findOrFail($id);

    // Clear old cart (optional but recommended)
    session()->forget('cart');

    // Add only this product to cart
    $cart = [];
    $cart[$id] = [
        //"name" => $product->{'name_' . app()->getLocale()} ?? $product->name_en,
        "product_id" => $product->id,
        "price" => $product->price,
        "quantity" => 1,
        "image" => $product->image,
    ];

    session()->put('cart', $cart);

    // Redirect DIRECTLY to checkout page
    return redirect()->route('checkout');
}


}

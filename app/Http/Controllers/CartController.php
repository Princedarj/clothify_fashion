<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $productIds = collect($cart)
            ->pluck('product_id')
            ->filter()
            ->values();

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        return view('cart.view', compact('cart', 'products'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "product_id" => $product->id,
                "name" => $product->name_en,
                "price" => $product->price,
                "quantity" => 1,
                "image" => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function addFromSession($action)
    {
        $product = \App\Models\Product::find($action['product_id']);

        if (!$product) return;

        $cart = session()->get('cart', []);

        $cart[$product->id] = [
                    "product_id" => $product->id,
                    "name" => $product->name_en,
                    "price" => $product->price,
                    "quantity" => $action['quantity'],
                    "image" => $product->image,
                ];

        session()->put('cart', $cart);
    }



public function view()
{
    $cart = session()->get('cart', []);

    // Get all product IDs from cart
    $productIds = array_column($cart, 'product_id');

    // Fetch products in one query
    $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

    return view('cart.view', compact('cart', 'products'));
}

    public function increase($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }

    return redirect()->back();
}

public function decrease($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
    }

    return redirect()->back();
}

public function checkout()
{
    $cart = session()->get('cart', []);

    return view('checkout', compact('cart'));
}

public function buyNow($id)
{
    $product = Product::findOrFail($id);

    // Optional: Clear old cart
    session()->forget('cart');

    // Add only this product
    $cart = [];
    $cart[$id] = [
            "product_id" => $product->id,
            "name" => $product->name_en,
            "price" => $product->price,
            "quantity" => 1,
            "image" => $product->image,
        ];
    session()->put('cart', $cart);

    // Redirect directly to checkout page
    return redirect()->route('checkout.page');
}


}

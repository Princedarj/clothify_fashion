<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    // ✅ PUBLIC VIEW ALL PRODUCTS
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    ///////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN CREATE PRODUCT
    public function create()
    {
        return view('admin.products.create');
    }

/////////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN STORE PRODUCT
    public function store(Request $request)
    {
            // Validation
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
                'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $imageName = null;

            // Upload Image
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/products'), $imageName);
            }
            
            // Save to Database
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            return redirect()->route('admin.products.index')
                            ->with('success', 'Product added successfully!');
        }
    
    //////////////////////////////////////////////////////////////////////////////////////
    
    // ✅ ADMIN EDIT PRODUCT
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN UPDATE PRODUCT
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('admin.products.index');
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN DELETE PRODUCT
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    /////////////////////////////////////////////////////////////////////////////////////////

    // ✅ PUBLIC VIEW SINGLE PRODUCT
   public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}

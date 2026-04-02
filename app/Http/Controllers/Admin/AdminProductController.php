<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Stichoza\GoogleTranslate\GoogleTranslate;


class AdminProductController extends Controller
{
    // 🔹 Show all products
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // 🔹 Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // 🔹 Store new product

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'required|image',
        'category_id' => 'required|exists:categories,id',
    ]);

    $name_en = $request->name;
    $desc_en = $request->description;

    try {
        $tr = new GoogleTranslate();
        $tr->setSource('en');

        // Hindi
        $tr->setTarget('hi');
        $name_hi = $tr->translate($name_en);
        $desc_hi = $tr->translate($desc_en);

        // Gujarati
        $tr->setTarget('gu');
        $name_gu = $tr->translate($name_en);
        $desc_gu = $tr->translate($desc_en);

    } catch (\Exception $e) {
        $name_hi = $name_en;
        $name_gu = $name_en;
        $desc_hi = $desc_en;
        $desc_gu = $desc_en;
    }

    // Image upload
    $imagePath = $request->file('image')->store('products', 'public');

    Product::create([
        'name_en' => $name_en,
        'name_hi' => $name_hi ?: $name_en,
        'name_gu' => $name_gu ?: $name_en,

        'description_en' => $desc_en,
        'description_hi' => $desc_hi ?: $desc_en,
        'description_gu' => $desc_gu ?: $desc_en,

        'price' => $request->price,
        'image' => $imagePath,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product added successfully!');
}

    // 🔹 Show edit form
    public function edit(Product $product)
{
    $categories = Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
}

    // 🔹 Update product
   public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'nullable|image',
        'category_id' => 'required|exists:categories,id'
    ]);

    $name_en = $request->name;
    $desc_en = $request->description;

    try {
        $tr = new GoogleTranslate();
        $tr->setSource('en');

        $tr->setTarget('hi');
        $name_hi = $tr->translate($name_en);
        $desc_hi = $tr->translate($desc_en);

        $tr->setTarget('gu');
        $name_gu = $tr->translate($name_en);
        $desc_gu = $tr->translate($desc_en);

    } catch (\Exception $e) {
        $name_hi = $name_en;
        $name_gu = $name_en;
        $desc_hi = $desc_en;
        $desc_gu = $desc_en;
    }

    // Image update
    if ($request->hasFile('image')) {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

    $product->update([
        'name_en' => $name_en,
        'name_hi' => $name_hi,
        'name_gu' => $name_gu,

        'description_en' => $desc_en,
        'description_hi' => $desc_hi,
        'description_gu' => $desc_gu,

        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully!');
}

    // 🔹 Delete product
    public function destroy(Product $product)
    {
        // Delete image from storage
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully!');
    }

    
}

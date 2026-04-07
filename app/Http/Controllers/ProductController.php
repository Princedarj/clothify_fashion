<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ProductController extends Controller
{
    // ✅ SHOW PRODUCTS
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->sort == 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    // ✅ CREATE PAGE
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // ✅ STORE PRODUCT (AUTO TRANSLATE)
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
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
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'name_en' => $name_en,
            'name_hi' => $name_hi,
            'name_gu' => $name_gu,

            'description_en' => $desc_en,
            'description_hi' => $desc_hi,
            'description_gu' => $desc_gu,

            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $imageName,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product added successfully!');
    }

    // ✅ EDIT
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // ✅ UPDATE (AUTO TRANSLATE AGAIN)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
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

        $product->update([
            'name_en' => $name_en,
            'name_hi' => $name_hi,
            'name_gu' => $name_gu,

            'description_en' => $desc_en,
            'description_hi' => $desc_hi,
            'description_gu' => $desc_gu,

            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    // ✅ DELETE
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }

    // ✅ SHOW SINGLE
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Stichoza\GoogleTranslate\GoogleTranslate;


class ProductController extends Controller
{
    // ✅ PUBLIC VIEW ALL PRODUCTS
    public function index(Request $request)
    {
        $query = Product::query();

        // Category Filter
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Price Filter
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        if ($request->sort == 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(8);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    ///////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN CREATE PRODUCT
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

/////////////////////////////////////////////////////////////////////////////////////

    // ✅ ADMIN STORE PRODUCTuse Stichoza\GoogleTranslate\GoogleTranslate;

public function store(Request $request)
{
    // ✅ Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'required|string',
        'image' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    // 🌐 Translator
    $tr = new GoogleTranslate();

    // 👉 English (original input)
    $name_en = $request->name;
    $desc_en = $request->description;

    // 👉 Hindi
    $tr->setTarget('hi');
    $name_hi = $tr->translate($name_en);
    $desc_hi = $tr->translate($desc_en);

    // 👉 Gujarati
    $tr->setTarget('gu');
    $name_gu = $tr->translate($name_en);
    $desc_gu = $tr->translate($desc_en);

    // 📸 Image Upload
    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/products'), $imageName);
    }

    // 💾 Save to Database
    Product::create([
        'name' => $name_en, // fallback

        'name_en' => $name_en,
        'name_hi' => $name_hi,
        'name_gu' => $name_gu,

        'description' => $desc_en, // fallback

        'description_en' => $desc_en,
        'description_hi' => $desc_hi,
        'description_gu' => $desc_gu,

        'category_id' => $request->category_id,
        'price' => $request->price,
        'image' => $imageName,
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product added with auto translation!');
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

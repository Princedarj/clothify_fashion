<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name_en = $request->name;

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('en');

            // Hindi
            $tr->setTarget('hi');
            $name_hi = $tr->translate($name_en);

            // Gujarati
            $tr->setTarget('gu');
            $name_gu = $tr->translate($name_en);

        } catch (\Exception $e) {
            $name_hi = $name_en;
            $name_gu = $name_en;
        }

        Category::create([
            'name_en' => $name_en,
            'name_hi' => $name_hi ?: $name_en,
            'name_gu' => $name_gu ?: $name_en,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category added successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}
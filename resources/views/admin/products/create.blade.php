@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        📦 Add New Product
    </h2>

    <form action="{{ route('admin.products.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        <!-- Product Name -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Product Name
            </label>
            <input type="text" 
                   name="name" 
                   placeholder="Enter product name"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <!-- Category -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Category
            </label>

            <select name="category_id"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>

                <option value="">Select Category</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach

            </select>
        </div>  

        <!-- Price -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Price (₹)
            </label>
            <input type="number" 
                   name="price" 
                   placeholder="Enter price"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Description
            </label>
            <textarea name="description"
                      rows="4"
                      placeholder="Enter product description"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                      required></textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Product Image
            </label>
            <input type="file" 
                   name="image"
                   accept=".jpg,.jpeg,.png,.pdf"
                   class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50"
                   required>

            <!-- <p class="text-sm text-gray-500 mt-2">
                Allowed formats: JPG, JPEG, PNG, PDF (Max 2MB)
            </p> -->
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-4">

            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
               ← Back
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">
                💾 Save Product
            </button>

        </div>

    </form>
</div>

@endsection
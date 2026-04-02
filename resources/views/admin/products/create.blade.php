@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
        📦 {{ __('messages.add_product') }}
    </h2>

    <form action="{{ route('admin.products.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf

        <!-- ✅ Product Name (ONLY ONE) -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Product Name
            </label>
            <input type="text" 
                   name="name" 
                   class="w-full border border-gray-300 rounded-lg p-3"
                   placeholder="Enter product name"
                   required>
        </div>

        <!-- ✅ Category -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.category') }}
            </label>

            <select name="category_id"
                    class="w-full border border-gray-300 rounded-lg p-3"
                    required>

                <option value="">{{ __('messages.select_category') }}</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->getName() ?? $category->name_en }}
                    </option>
                @endforeach

            </select>
        </div>  

        <!-- ✅ Price -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.price') }} (₹)
            </label>
            <input type="number" 
                   name="price" 
                   class="w-full border border-gray-300 rounded-lg p-3"
                   required>
        </div>

        <!-- ✅ Description (ONLY ONE) -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                Description
            </label>
            <textarea name="description" 
                      class="w-full border border-gray-300 rounded-lg p-3"
                      required></textarea>
        </div>

        <!-- ✅ Image -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.product_image') }}
            </label>
            <input type="file" 
                   name="image"
                   accept=".jpg,.jpeg,.png"
                   class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50"
                   required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-4">

            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
               ← {{ __('messages.back') }}
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                💾 {{ __('messages.save_product') }}
            </button>

        </div>

    </form>
</div>

@endsection
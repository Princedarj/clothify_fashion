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

        <!-- Product Name -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.product_name') }}
            </label>
            <input type="text" 
                   name="name" 
                   placeholder="{{ __('messages.enter_product_name') }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   required>
        </div>

        <!-- Category -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.category') }}
            </label>

            <select name="category_id"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>

                <option value="">{{ __('messages.select_category') }}</option>

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
                {{ __('messages.price') }} (₹)
            </label>
            <input type="number" 
                   name="price" 
                   placeholder="{{ __('messages.enter_price') }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.description') }}
            </label>
            <textarea name="description"
                      rows="4"
                      placeholder="{{ __('messages.enter_description') }}"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                      required></textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block mb-2 font-semibold text-gray-700">
                {{ __('messages.product_image') }}
            </label>
            <input type="file" 
                   name="image"
                   accept=".jpg,.jpeg,.png,.pdf"
                   class="w-full border border-gray-300 rounded-lg p-3 bg-gray-50"
                   required>
        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center pt-4">

            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
               ← {{ __('messages.back') }}
            </a>

            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">
                💾 {{ __('messages.save_product') }}
            </button>

        </div>

    </form>
</div>

@endsection
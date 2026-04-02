@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">{{ __('messages.edit_product') }}</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">{{ __('messages.product_name') }}</label>
            <input type="text" name="name" value="{{ $product->getName() }}"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Category --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">{{ __('messages.category') }}</label>

            <select name="category_id" class="w-full border rounded px-3 py-2">
                <option value="">{{ __('messages.select_category') }}</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->getName() }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- Price --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">{{ __('messages.price') }}</label>
            <input type="number" name="price" value="{{ $product->price }}"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">{{ __('messages.description') }}</label>
            <textarea name="description" rows="4"
                class="w-full border rounded px-3 py-2">{{ $product->getDescription() }}</textarea>
        </div>

        {{-- Current Image --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">{{ __('messages.current_image') }}</label>

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="h-40 object-contain mb-3">
            @endif

            <input type="file" name="image" class="w-full">
        </div>

        {{-- Button --}}
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            {{ __('messages.update_product') }}
        </button>

    </form>
</div>

@endsection
@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Product Name</label>
            <input type="text" name="name" value="{{ $product->name }}"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Price --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Price</label>
            <input type="number" name="price" value="{{ $product->price }}"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border rounded px-3 py-2">{{ $product->description }}</textarea>
        </div>

        {{-- Current Image --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Current Image</label>

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="h-40 object-contain mb-3">
            @endif

            <input type="file" name="image" class="w-full">
        </div>

        {{-- Button --}}
        <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Update Product
        </button>

    </form>
</div>

@endsection

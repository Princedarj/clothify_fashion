@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Manage Products</h1>

<a href="{{ route('admin.products.create') }}"
   class="bg-indigo-600 text-white px-4 py-2 rounded">
   + Add Product
</a>

<table class="w-full mt-6 border">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">Name</th>
            <th class="p-2">Price</th>
            <th class="p-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="border-t">
            <td class="p-2">{{ $product->name }}</td>
            <td class="p-2">₹{{ $product->price }}</td>
            <td class="p-2">

                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="text-blue-600">Edit</a>

                <form action="{{ route('admin.products.destroy', $product->id) }}"
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 ml-3">
                        Delete
                    </button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
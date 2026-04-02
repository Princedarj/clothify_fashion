@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded-xl shadow-sm">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('messages.manage_products') }}</h1>

        <a href="{{ route('admin.products.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition duration-200">
           + {{ __('messages.add_product') }}
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <th class="p-3 text-left">{{ __('messages.product_name') }}</th>
                    <th class="p-3 text-left">{{ __('messages.price') }}</th>
                    <th class="p-3 text-center">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 font-medium">
                        {{ $product->getName() }}
                    </td>
                    <td class="p-3">
                        ₹ {{ number_format($product->price, 2) }}
                    </td>
                    <td class="p-3 text-center">

                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-md text-sm hover:bg-blue-200 transition">
                           {{ __('messages.edit') }}
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              class="inline-block ml-2"
                              onsubmit="return confirm('{{ __('messages.delete_product_confirm') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-100 text-red-600 px-3 py-1 rounded-md text-sm hover:bg-red-200 transition">
                                {{ __('messages.delete') }}
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach

                @if($products->isEmpty())
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        {{ __('messages.no_products') }}
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

</div>

@endsection
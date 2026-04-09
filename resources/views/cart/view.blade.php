@extends('layouts.user')

@section('content')
@php
    $cart = session()->get('cart', []);
@endphp

<div class="py-12 max-w-6xl mx-auto px-4">

    <h2 class="text-3xl font-bold mb-8 text-gray-900">
        {{ __('messages.Your Cart') }} 🛒
    </h2>

    @if(empty($cart))
        <p class="text-gray-500 text-lg">
            {{ __('messages.Your Cart is Empty') }}
        </p>
    @else

        <div class="space-y-6">

            @php 
                $subtotal = 0; 
            @endphp

            @foreach($cart as $id => $item)
                @php
                    $total = $item['price'] * $item['quantity'];
                    $subtotal += $total;
                @endphp

                <div class="grid grid-cols-5 md:grid-cols-5 items-center bg-white shadow-md rounded-xl p-4 border border-gray-200 hover:shadow-xl transition duration-300">

                    <!-- Product Name -->
                    <div class="col-span-2 font-semibold text-gray-800">
                        @php
                            $productId = $item['product_id'] ?? null;
                            $product = $productId && isset($products[$productId]) ? $products[$productId] : null;
                        @endphp

                        @if($product)
                            {{ $product->{'name_' . app()->getLocale()} ?? $product->name_en }}
                        @else
                            {{ $item['name'] ?? 'Product' }}
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="text-center">
                        ₹ {{ $item['price'] }}
                    </div>

                    <!-- Quantity -->
                    <div class="flex justify-center items-center gap-2">
                        <form method="POST" action="{{ route('cart.decrease', $id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-red-600 text-white rounded">−</button>
                        </form>

                        <span class="font-bold">{{ $item['quantity'] }}</span>

                        <form method="POST" action="{{ route('cart.increase', $id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-green-600 text-white rounded">+</button>
                        </form>
                    </div>

                    @php
                        $tax = $subtotal * 0.18;
                        $grandTotal = $subtotal + $tax;
                    @endphp

                    <!-- Total -->
                    <div class="text-center font-bold text-gray-900">
                        ₹ {{ $total }}
                    </div>

                </div>
            @endforeach

        </div>

        <!-- Grand Total & Checkout -->
        <div class="mt-8 bg-gray-100 p-6 rounded-lg">

            <div class="flex justify-between text-gray-700 mb-2">
                <span>{{ __('messages.Sub_total') }}</span>
                <span>₹ {{ number_format($subtotal, 2) }}</span>
            </div>

            <div class="flex justify-between text-gray-700 mb-2">
                <span>{{ __('messages.Tax') }}</span>
                <span>₹ {{ number_format($tax, 2) }}</span>
            </div>

            <hr class="my-3">

            <div class="flex justify-between text-lg font-bold text-gray-900">
                <span>{{ __('messages.Grand_Total') }}</span>
                <span>₹ {{ number_format($grandTotal, 2) }}</span>
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('checkout') }}"
                class="px-6 py-2 bg-blue-700 text-white font-medium rounded-lg hover:bg-blue-800 transition">
                    {{ __('messages.Proceed to Checkout') }} →
                </a>
            </div>

        </div>

    @endif

</div>
@include('layouts.footer')
@endsection
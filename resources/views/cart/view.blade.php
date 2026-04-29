@extends('layouts.user')

@section('content')

@php
    $cart = session()->get('cart', []);
@endphp

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 transition-colors mt-20">

    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="mb-10 bg-gradient-to-r from-black via-indigo-800 to-purple-900 dark:from-gray-900 dark:via-indigo-900 dark:to-black text-white rounded-[2rem] p-8 shadow-xl">
            <p class="text-sm uppercase tracking-[0.3em] text-gray-300 mb-3">
                {{ __('messages.shopping_cart') }}
            </p>

            <h2 class="text-4xl font-extrabold">
                {{ __('messages.Your Cart') }} 🛒
            </h2>

            <p class="text-gray-300 mt-2">
                {{ __('messages.cart_desc') }}
            </p>
        </div>

        @if(empty($cart))

            {{-- Empty Cart --}}
            <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-12 text-center">

                <div class="text-6xl mb-5">🛒</div>

                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">
                    {{ __('messages.Your Cart is Empty') }}
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('messages.empty_cart_desc') }}
                </p>

                <a href="{{ route('products.index') }}"
                   class="inline-block px-8 py-3 bg-black dark:bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                    🛍️ {{ __('messages.continue_shopping') }}
                </a>

            </div>

        @else

            @php
                $subtotal = 0;
            @endphp

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-5">

                    @foreach($cart as $id => $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $subtotal += $total;

                            $productId = $item['product_id'] ?? null;
                            $product = $productId && isset($products[$productId]) ? $products[$productId] : null;
                        @endphp

                        <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-6 hover:shadow-2xl transition">

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-5 md:items-center">

                                {{-- Product --}}
                                <div class="md:col-span-2">
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2">
                                        {{ __('messages.product') }}
                                    </p>

                                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">
                                        @if($product)
                                            {{ $product->{'name_' . app()->getLocale()} ?? $product->name_en }}
                                        @else
                                            {{ $item['name'] ?? __('messages.product') }}
                                        @endif
                                    </h3>
                                </div>

                                {{-- Price --}}
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2">
                                        {{ __('messages.price') }}
                                    </p>

                                    <p class="font-bold text-gray-900 dark:text-white">
                                        ₹{{ number_format($item['price'], 2) }}
                                    </p>
                                </div>

                                {{-- Quantity --}}
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2">
                                        {{ __('messages.quantity') }}
                                    </p>

                                    <div class="flex items-center gap-3">
                                        <form method="POST" action="{{ route('cart.decrease', $id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="w-9 h-9 rounded-full bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 font-bold hover:bg-red-600 hover:text-white transition">
                                                −
                                            </button>
                                        </form>

                                        <span class="w-10 text-center font-extrabold text-gray-900 dark:text-white">
                                            {{ $item['quantity'] }}
                                        </span>

                                        <form method="POST" action="{{ route('cart.increase', $id) }}">
                                            @csrf
                                            <button type="submit"
                                                class="w-9 h-9 rounded-full bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 font-bold hover:bg-green-600 hover:text-white transition">
                                                +
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                {{-- Total --}}
                                <div>
                                    <p class="text-xs uppercase tracking-[0.2em] text-gray-400 mb-2">
                                        {{ __('messages.total') }}
                                    </p>

                                    <p class="text-xl font-extrabold text-gray-900 dark:text-white">
                                        ₹{{ number_format($total, 2) }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- Order Summary --}}
                @php
                    $tax = $subtotal * 0.18;
                    $grandTotal = $subtotal + $tax;
                @endphp

                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-800 p-7 sticky top-24">

                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-6">
                            🧾 {{ __('messages.order_summary') }}
                        </h3>

                        <div class="space-y-4 text-sm">

                            <div class="flex justify-between text-gray-600 dark:text-gray-300">
                                <span>{{ __('messages.Sub_total') }}</span>
                                <span class="font-bold text-gray-900 dark:text-white">
                                    ₹{{ number_format($subtotal, 2) }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-600 dark:text-gray-300">
                                <span>{{ __('messages.Tax') }}</span>
                                <span class="font-bold text-gray-900 dark:text-white">
                                    ₹{{ number_format($tax, 2) }}
                                </span>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-800 pt-4 flex justify-between">
                                <span class="text-lg font-extrabold text-gray-900 dark:text-white">
                                    {{ __('messages.Grand_Total') }}
                                </span>

                                <span class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">
                                    ₹{{ number_format($grandTotal, 2) }}
                                </span>
                            </div>

                        </div>

                        <a href="{{ route('checkout') }}"
                           class="mt-7 block text-center w-full bg-black dark:bg-indigo-600 text-white py-4 rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-lg transition">
                            {{ __('messages.Proceed to Checkout') }} →
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="mt-3 block text-center w-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 py-3 rounded-full font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                            {{ __('messages.continue_shopping') }}
                        </a>

                    </div>
                </div>

            </div>

        @endif

    </div>

</div>

@endsection
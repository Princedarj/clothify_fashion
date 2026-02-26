@extends('layouts.user')

@section('content')
@php
    $cart = session()->get('cart', []);
@endphp

<div class="py-12 max-w-6xl mx-auto px-4">

    <h2 class="text-3xl font-bold mb-8 text-gray-900">
        Your Cart 🛒
    </h2>

    @if(empty($cart))
        <p class="text-gray-500 text-lg">Your cart is empty.</p>
    @else

        <div class="space-y-6">

            @php $grandTotal = 0; @endphp

            @foreach($cart as $id => $item)
                @php
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                @endphp

                <div class="flex flex-col md:flex-row justify-between items-center bg-white shadow-md rounded-xl p-4 border border-gray-200 hover:shadow-xl transition duration-300">
                    
                    <!-- Product Name -->
                    <div class="flex-1 text-left mb-2 md:mb-0">
                        <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                    </div>

                    <!-- Price -->
                    <div class="w-24 text-center mb-2 md:mb-0">
                        ₹ {{ $item['price'] }}
                    </div>

                    <!-- Quantity -->
                    <div class="flex justify-center items-center gap-2 mb-2 md:mb-0">
                        <form method="POST" action="{{ route('cart.decrease', $id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">−</button>
                        </form>

                        <span class="font-bold text-gray-800">{{ $item['quantity'] }}</span>

                        <form method="POST" action="{{ route('cart.increase', $id) }}">
                            @csrf
                            <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition">+</button>
                        </form>
                    </div>

                    <!-- Total -->
                    <div class="w-24 text-center font-bold text-gray-900">
                        ₹ {{ $total }}
                    </div>

                </div>
            @endforeach

        </div>

        <!-- Grand Total & Checkout -->
        <div class="mt-8 flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg">
            <div class="text-lg font-semibold text-gray-800">
                Grand Total: ₹ {{ $grandTotal }}
            </div>

            <a href="{{ route('checkout') }}"
               class="mt-4 md:mt-0 px-6 py-2 bg-blue-700 text-white font-medium rounded-lg hover:bg-blue-800 transition">
                Proceed to Checkout →
            </a>
        </div>

    @endif

</div>
@endsection
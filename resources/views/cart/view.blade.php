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

            @php $grandTotal = 0; @endphp

            @foreach($cart as $id => $item)
                @php
                    $total = $item['price'] * $item['quantity'];
                    $grandTotal += $total;
                @endphp

                <div class="grid grid-cols-5 md:grid-cols-5 items-center bg-white shadow-md rounded-xl p-4 border border-gray-200 hover:shadow-xl transition duration-300">

                    <!-- Product Name -->
                    <div class="col-span-2 font-semibold text-gray-800">
                        {{ $item['name'] }}
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

                    <!-- Total -->
                    <div class="text-center font-bold text-gray-900">
                        ₹ {{ $total }}
                    </div>

                </div>
            @endforeach

        </div>

        <!-- Grand Total & Checkout -->
        <div class="mt-8 flex flex-col md:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg">
            <div class="text-lg font-semibold text-gray-800">
                {{ __('messages.Grand Total') }}: ₹ {{ $grandTotal }}
            </div>

            <a href="{{ route('checkout') }}"
               class="mt-4 md:mt-0 px-6 py-2 bg-blue-700 text-white font-medium rounded-lg hover:bg-blue-800 transition">
                {{ __('messages.Proceed to Checkout') }} →
            </a>
        </div>

    @endif

</div>
@include('layouts.footer')
@endsection
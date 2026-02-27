@extends('layouts.user')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

    <div class="bg-white shadow-xl rounded-2xl p-10 max-w-md w-full text-center border border-gray-200">

        <!-- Success Icon -->
        <div class="w-20 h-20 mx-auto flex items-center justify-center rounded-full bg-green-100 mb-6">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="3"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <!-- Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-3">
            Order Placed Successfully 🎉
        </h2>

        <p class="text-gray-600 mb-6">
            Thank you for shopping with us. Your order has been confirmed and is being processed.
        </p>

        <!-- Order ID -->
        <div class="bg-gray-100 rounded-lg py-3 px-4 mb-6">
            <p class="text-sm text-gray-500">Order ID</p>
            <p class="font-semibold text-gray-900">#{{ $order->id }}</p>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('products.index') }}"
               class="flex-1 bg-gray-900 text-white py-3 rounded-lg 
                      hover:bg-yellow-500 hover:text-black transition duration-300 font-medium">
                Continue Shopping
            </a>

            <a href="{{ route('user.orders.invoice', $order->id) }}"
               class="flex-1 bg-green-600 text-white py-3 rounded-lg 
                      hover:bg-green-700 transition duration-300 font-medium">
                Download Invoice
            </a>

        </div>

    </div>

</div>

@include('layouts.footer')
@endsection
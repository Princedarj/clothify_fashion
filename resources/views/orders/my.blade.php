@extends('layouts.user')

@section('content')
<div class="py-12 max-w-6xl mx-auto px-4">

    <h2 class="text-3xl font-bold mb-8 text-gray-900">
        My Orders 📦
    </h2>

    @if($orders->isEmpty())
        <p class="text-gray-500 text-lg">You have no orders yet.</p>
    @else
        <div class="grid gap-6 md:grid-cols-2">

            @foreach($orders as $order)
                <div class="bg-white shadow-lg rounded-xl p-6 border border-gray-200 hover:shadow-xl transition duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600 font-semibold">Order ID: #{{ $order->id }}</span>
                        <span class="text-gray-800 font-bold">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="text-gray-600 font-medium">Status:</span>
                        @if($order->status == 'Pending')
                            <span class="inline-block bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full ml-2">
                                {{ $order->status }}
                            </span>
                        @elseif($order->status == 'Delivered')
                            <span class="inline-block bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full ml-2">
                                {{ $order->status }}
                            </span>
                        @elseif($order->status == 'Cancelled')
                            <span class="inline-block bg-red-200 text-red-800 text-xs px-2 py-1 rounded-full ml-2">
                                {{ $order->status }}
                            </span>
                        @else
                            <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full ml-2">
                                {{ $order->status }}
                            </span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <span class="text-gray-600 font-medium">Address:</span>
                        <p class="text-gray-800">{{ $order->address }}</p>
                    </div>

                    <a href="{{ route('user.orders.invoice', $order->id) }}"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Download Invoice
                    </a>
                </div>
            @endforeach

        </div>
    @endif

</div>
@endsection
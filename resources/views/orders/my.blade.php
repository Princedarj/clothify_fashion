@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 transition-colors">

    <div class="max-w-7xl mx-auto mt-10">

        {{-- Header --}}
        <div class="mb-10 bg-gradient-to-r from-black via-indigo-800 to-purple-900 dark:from-gray-900 dark:via-indigo-900 dark:to-black text-white rounded-[2rem] p-8 shadow-xl">

            <p class="text-sm uppercase tracking-[0.3em] text-gray-300 mb-3">
                {{ __('messages.order_history') }}
            </p>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h2 class="text-4xl font-extrabold">
                        {{ __('messages.My Orders') }} 📦
                    </h2>

                    <p class="text-gray-300 mt-2">
                        {{ __('messages.order_history_desc') }}
                    </p>
                </div>

                <div class="bg-white/10 px-6 py-4 rounded-2xl border border-white/10">
                    <p class="text-sm text-gray-300">
                        {{ __('messages.total_orders') }}
                    </p>
                    <p class="text-3xl font-extrabold">
                        {{ $orders->count() }}
                    </p>
                </div>

            </div>
        </div>

        {{-- No Orders --}}
        @if($orders->isEmpty())

            <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-12 text-center">

                <div class="text-6xl mb-5">📦</div>

                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-3">
                    {{ __('messages.No Orders') }}
                </h3>

                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('messages.no_orders_desc') }}
                </p>

                <a href="{{ route('products.index') }}"
                   class="inline-block px-8 py-3 bg-black dark:bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                    🛍️ {{ __('messages.start_shopping') }}
                </a>

            </div>

        @else

            {{-- Orders Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($orders as $order)

                    <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-6 hover:shadow-2xl transition duration-300">

                        {{-- Order Top --}}
                        <div class="flex justify-between items-start mb-5">

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('messages.Order ID') }}
                                </p>

                                <h3 class="text-xl font-extrabold text-gray-900 dark:text-white">
                                    #{{ $order->id }}
                                </h3>
                            </div>

                            <div class="text-right">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('messages.total') }}
                                </p>

                                <p class="text-xl font-bold text-gray-900 dark:text-white">
                                    ₹{{ number_format($order->grand_total, 2) }}
                                </p>
                            </div>

                        </div>

                        {{-- Status --}}
                        <div class="mb-5">

                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                {{ __('messages.Status') }}
                            </p>

                            @if($order->status == 'Pending')
                                <span class="inline-block bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400 text-xs px-4 py-2 rounded-full font-bold">
                                    ⏳ {{ __('messages.Pending') }}
                                </span>

                            @elseif($order->status == 'Delivered')
                                <span class="inline-block bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs px-4 py-2 rounded-full font-bold">
                                    ✅ {{ __('messages.Delivered') }}
                                </span>

                            @elseif($order->status == 'Cancelled')
                                <span class="inline-block bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs px-4 py-2 rounded-full font-bold">
                                    ❌ {{ __('messages.Cancelled') }}
                                </span>

                            @else
                                <span class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs px-4 py-2 rounded-full font-bold">
                                    {{ $order->status }}
                                </span>
                            @endif

                        </div>

                        {{-- Address --}}
                        <div class="mb-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                {{ __('messages.Address') }}
                            </p>

                            <p class="text-gray-800 dark:text-gray-300 text-sm leading-relaxed">
                                {{ $order->address }}
                            </p>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex gap-3">

                            <a href="{{ route('user.orders.invoice', $order->id) }}"
                               class="flex-1 text-center bg-indigo-600 text-white py-3 rounded-full text-sm font-bold hover:bg-indigo-700 transition">
                                📄 {{ __('messages.Download Invoice') }}
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection
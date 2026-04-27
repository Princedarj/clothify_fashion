@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 px-4 py-16 transition-colors mt-20">

    <div class="max-w-5xl mx-auto ">

        <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">

            {{-- Top Banner --}}
            <div class="relative bg-gradient-to-r from-green-600 via-emerald-600 to-indigo-700 text-white px-8 py-12 text-center overflow-hidden">

                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(255,255,255,0.25),transparent_35%)]"></div>

                <div class="relative">
                    <div class="w-24 h-24 mx-auto flex items-center justify-center rounded-full bg-white/20 border border-white/30 mb-6 shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <p class="text-sm uppercase tracking-[0.3em] text-green-100 mb-3">
                        {{ __('messages.order_confirmed') }}
                    </p>

                    <h2 class="text-4xl md:text-5xl font-extrabold mb-4">
                        {{ __('messages.Order Success') }} 🎉
                    </h2>

                    <p class="text-green-50 max-w-2xl mx-auto">
                        {{ __('messages.Order Success Description') }}
                    </p>
                </div>

            </div>

            {{-- Body --}}
            <div class="p-8 md:p-10">

                <div class="grid md:grid-cols-3 gap-6 mb-8">

                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.Order ID') }}
                        </p>
                        <p class="text-2xl font-extrabold text-gray-900 dark:text-white mt-1">
                            #{{ $order->id }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.payment') }}
                        </p>
                        <p class="text-lg font-bold text-green-600 dark:text-green-400 mt-1">
                            {{ __('messages.secure') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 border border-gray-100 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.delivery') }}
                        </p>
                        <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                            {{ __('messages.fast_delivery') }}
                        </p>
                    </div>

                </div>

                {{-- Steps --}}
                <div class="bg-indigo-50 dark:bg-indigo-950 border border-indigo-100 dark:border-indigo-900 rounded-2xl p-6 mb-8">
                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-white mb-5">
                        {{ __('messages.what_happens_next') }}
                    </h3>

                    <div class="grid md:grid-cols-3 gap-5 text-sm">
                        <div class="flex gap-3">
                            <span class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 flex items-center justify-center shadow">
                                📩
                            </span>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">
                                    {{ __('messages.order_email_sent') }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('messages.order_email_sent_desc') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <span class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 flex items-center justify-center shadow">
                                📦
                            </span>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">
                                    {{ __('messages.order_packed') }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('messages.order_packed_desc') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <span class="w-10 h-10 rounded-full bg-white dark:bg-gray-900 flex items-center justify-center shadow">
                                🚚
                            </span>
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">
                                    {{ __('messages.order_delivery') }}
                                </p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    {{ __('messages.order_delivery_desc') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    <a href="{{ route('products.index') }}"
                       class="flex-1 text-center bg-black dark:bg-indigo-600 text-white py-4 rounded-full hover:bg-indigo-600 dark:hover:bg-indigo-700 transition font-bold shadow-lg">
                        🛍️ {{ __('messages.Continue Shopping') }}
                    </a>

                    <a href="{{ route('user.orders.invoice', $order->id) }}"
                       class="flex-1 text-center bg-green-600 text-white py-4 rounded-full hover:bg-green-700 transition font-bold shadow-lg">
                        📄 {{ __('messages.Download Invoice') }}
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection
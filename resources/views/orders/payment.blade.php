@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 px-4 py-14 transition-colors">

    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-10">
            <p class="text-sm uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400 mb-2">
                {{ __('messages.secure_checkout') }}
            </p>

            <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">
                {{ __('messages.payment_options') }}
            </h2>

            <p class="text-gray-500 dark:text-gray-400 mt-3">
                {{ __('messages.payment_options_desc') }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            {{-- QR Payment --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-[2rem] p-8 shadow-xl text-center">

                <div class="w-14 h-14 mx-auto rounded-full bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 flex items-center justify-center text-2xl mb-5">
                    📱
                </div>

                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-4">
                    {{ __('messages.scan_qr') }}
                </h3>

                <div class="bg-gray-50 dark:bg-gray-800 rounded-3xl p-5 border border-gray-100 dark:border-gray-700 mb-5">
                    <img src="{{ asset('images/payment-qr.png') }}"
                         class="w-64 mx-auto rounded-2xl"
                         alt="{{ __('messages.scan_qr') }}">
                </div>

                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    {{ __('messages.scan_qr_desc') }}
                </p>

                <form method="POST" action="{{ route('payment.success', $order->id) }}">
                    @csrf
                    <input type="hidden" name="payment_method" value="QR">

                    <button type="submit"
                        class="w-full bg-green-600 text-white py-3 rounded-full font-bold hover:bg-green-700 hover:shadow-lg transition">
                        ✅ {{ __('messages.payment_completed') }}
                    </button>
                </form>

            </div>

            {{-- UPI Payment --}}
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-[2rem] p-8 shadow-xl">

                <div class="w-14 h-14 rounded-full bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-2xl mb-5">
                    💳
                </div>

                <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-4">
                    {{ __('messages.pay_using_upi') }}
                </h3>

                <p class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('messages.upi_id') }}
                </p>

                <div class="bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl px-5 py-4 mb-5 flex items-center justify-between gap-3">
                    <span class="font-bold text-gray-900 dark:text-white">
                        clothify@upi
                    </span>

                    <button type="button"
                        onclick="navigator.clipboard.writeText('clothify@upi')"
                        class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                        {{ __('messages.copy') }}
                    </button>
                </div>

                <form method="POST" action="{{ route('payment.success', $order->id) }}">
                    @csrf
                    <input type="hidden" name="payment_method" value="UPI">

                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        {{ __('messages.transaction_code') }}
                    </label>

                    <input type="text"
                        name="transaction_code"
                        placeholder="{{ __('messages.enter_transaction_code') }}"
                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 mb-5 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>

                    <button type="submit"
                        class="w-full bg-black dark:bg-indigo-600 text-white py-3 rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-lg transition">
                        {{ __('messages.confirm_payment') }}
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

@endsection
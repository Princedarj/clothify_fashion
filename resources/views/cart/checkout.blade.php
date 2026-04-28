@extends('layouts.user')

@section('content')

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 transition-colors mt-20">

        <div class="max-w-5xl mx-auto mt-30">

            <div class="mb-8 text-center">
                <p class="text-sm uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('messages.secure_checkout') }}
                </p>

                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white">
                    {{ __('messages.Checkout') }} 🛒
                </h2>
            </div>

            @if(session('success'))
                <div
                    class="mb-6 bg-green-100 dark:bg-green-950 text-green-800 dark:text-green-300 px-5 py-4 rounded-2xl border border-green-200 dark:border-green-800 shadow-sm">
                    {{ __(session('success')) }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 text-red-700 px-5 py-4 rounded-2xl border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- Checkout Form --}}
                <div
                    class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-[2rem] shadow-xl border border-gray-100 dark:border-gray-800 p-8">

                    <div class="flex items-center gap-3 mb-8">
                        <div
                            class="w-12 h-12 rounded-full bg-black dark:bg-indigo-600 text-white flex items-center justify-center text-xl">
                            📦
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ __('messages.delivery_details') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('messages.delivery_details_desc') }}
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('order.place') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-5">

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.Name') }}
                                </label>
                                <input type="text" name="name" required value="{{ auth()->user()->name ?? '' }}"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.Email') }}
                                </label>
                                <input type="email" name="email" required value="{{ auth()->user()->email ?? '' }}"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.Phone') }}
                                </label>

                                <input type="tel" id="phoneInput" name="phone" value="{{ old('phone') }}" required
                                    maxlength="10" minlength="10" pattern="[0-9]{10}" inputmode="numeric" autocomplete="off"
                                    placeholder="{{ __('messages.enter_10_digit_number') }}"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    {{ __('messages.Pincode') }}
                                </label>

                                <input type="tel" id="pincodeInput" name="pincode" value="{{ old('pincode') }}" required
                                    maxlength="6" minlength="6" pattern="[0-9]{6}" inputmode="numeric" autocomplete="off"
                                    placeholder="{{ __('messages.enter_pincode') }}"
                                    class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3">
                            </div>

                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                {{ __('messages.Address') }}
                            </label>
                            <textarea name="address" rows="4" required
                                class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-black dark:bg-indigo-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-xl transition">
                            {{ __('messages.Place Order') }} →
                        </button>
                    </form>
                </div>

                {{-- Side Info --}}
                <div class="space-y-5">

                    <div class="bg-black dark:bg-indigo-600 text-white rounded-[2rem] p-7 shadow-xl">
                        <h3 class="text-xl font-bold mb-4">
                            🛡️ {{ __('messages.safe_secure') }}
                        </h3>
                        <p class="text-gray-300 dark:text-indigo-100 text-sm leading-relaxed">
                            {{ __('messages.safe_secure_desc') }}
                        </p>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border border-gray-100 dark:border-gray-800">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                            {{ __('messages.why_shop_with_us') }}
                        </h3>

                        <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                            <div class="flex items-center gap-3">
                                <span
                                    class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">🚚</span>
                                <span>{{ __('messages.fast_delivery') }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span
                                    class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">💎</span>
                                <span>{{ __('messages.premium_mens_wear') }}</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span
                                    class="w-10 h-10 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">🔁</span>
                                <span>{{ __('messages.easy_return_policy') }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            function restrictNumbers(inputId, maxLength) {
                const input = document.getElementById(inputId);

                if (!input) return;

                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '').substring(0, maxLength);
                });

                input.addEventListener('paste', function (e) {
                    e.preventDefault();

                    this.value = (e.clipboardData || window.clipboardData)
                        .getData('text')
                        .replace(/\D/g, '')
                        .substring(0, maxLength);
                });
            }

            restrictNumbers('phoneInput', 10);
            restrictNumbers('pincodeInput', 6);

        });
    </script>
@endsection
@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-[#f8f4ec] flex flex-col items-center justify-center px-4 py-6">

    <!-- TOP LOGO -->
    <div class="mb-4">
        <img src="{{ asset('images/Clothify.png') }}"
             alt="Clothify Fashions"
             class="w-28 sm:w-32 lg:w-36 h-auto mx-auto">
    </div>

    <!-- MAIN CARD -->
    <div class="w-full max-w-[950px] lg:max-w-[900px] bg-white rounded-[28px] lg:rounded-[32px] shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="relative bg-[#081f45] flex flex-col items-center justify-center text-white px-6 sm:px-10 py-10 overflow-hidden min-h-[330px]">

            <div class="absolute bottom-0 left-[-140px] w-[300px] h-[300px] border-2 border-dashed border-[#c28a34]/40 rounded-full"></div>
            <div class="absolute bottom-10 left-[-100px] w-[220px] h-[220px] border-2 border-dashed border-[#c28a34]/30 rounded-full"></div>

            <div class="absolute bottom-0 right-8 opacity-[0.04] text-[120px] lg:text-[140px] text-white font-bold">
                ♛
            </div>

            <div class="relative z-10 text-center">

                <img src="{{ asset('images/Clothify.png') }}"
                     alt="Clothify Logo"
                     class="w-36 sm:w-44 lg:w-56 mx-auto mb-4 lg:mb-6 rounded-full">

                <h2 class="text-2xl lg:text-3xl font-extrabold mb-2 lg:mb-3">
                    Join Clothify!
                </h2>

                <div class="w-14 h-1 bg-[#c28a34] rounded-full mx-auto mb-4 lg:mb-5"></div>

                <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                    Create your account and explore<br>
                    premium fashion collections.
                </p>

            </div>
        </div>


        <!-- RIGHT SIDE -->
        <div class="bg-white flex flex-col justify-center px-6 sm:px-8 lg:px-10 py-6">

            <div class="text-center mb-6">
                <p class="text-[#b9822c] tracking-[0.35em] lg:tracking-[0.45em] text-xs lg:text-sm font-extrabold uppercase mb-3">
                    Create Account
                </p>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-[#081f45]">
                    Register
                </h1>

                <p class="text-gray-500 mt-3 text-sm lg:text-base">
                    Fill your details to start shopping.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Name') }}
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               autocomplete="name"
                               placeholder="{{ __('messages.Name') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Email') }}
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="username"
                               placeholder="{{ __('messages.Email') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Phone') }}
                        </label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               maxlength="10"
                               inputmode="numeric"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)"
                               placeholder="{{ __('messages.Phone') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.City') }}
                        </label>

                        <input type="text"
                               name="city"
                               value="{{ old('city') }}"
                               placeholder="{{ __('messages.City') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">
                    </div>

                    <!-- Language -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Preferred Language') }}
                        </label>

                        <select name="language"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                            <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>
                                {{ __('messages.English') }}
                            </option>

                            <option value="hi" {{ old('language') == 'hi' ? 'selected' : '' }}>
                                {{ __('messages.Hindi') }}
                            </option>

                            <option value="gu" {{ old('language') == 'gu' ? 'selected' : '' }}>
                                {{ __('messages.Gujarati') }}
                            </option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Password') }}
                        </label>

                        <input type="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               placeholder="{{ __('messages.Password') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#081f45] mb-2">
                            {{ __('messages.Confirm Password') }}
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               placeholder="{{ __('messages.Confirm Password') }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                </div>

                <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#c48a32] to-[#a66d20] text-white font-extrabold tracking-widest shadow-lg hover:shadow-xl transition">
                    {{ __('messages.Register') }}
                </button>

            </form>

            <p class="text-center mt-5 text-gray-500 text-sm">
                {{ __('messages.Already Registered') }}?
                <a href="{{ route('login') }}"
                   class="font-bold text-[#b9822c] hover:text-[#8b5d1d]">
                    {{ __('messages.Log In') }}
                </a>
            </p>

        </div>

    </div>

</div>

@endsection
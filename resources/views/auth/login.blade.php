@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-[#f8f4ec] flex flex-col items-center justify-center px-4 py-6 lg:py-0">

    <!-- TOP LOGO -->
    <div class="mb-4">
        <img src="{{ asset('images/Clothify.png') }}"
             alt="Clothify Fashions"
             class="w-28 sm:w-32 lg:w-36 h-auto mx-auto">
    </div>

    <!-- MAIN CARD -->
    <div class="w-full max-w-[1000px] bg-white rounded-[28px] lg:rounded-[32px] shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 lg:h-[600px]">

        <!-- LEFT SIDE -->
        <div class="relative bg-[#081f45] flex flex-col items-center justify-center text-white px-6 sm:px-10 py-10 lg:py-0 overflow-hidden min-h-[330px] lg:min-h-0">

            <div class="absolute bottom-0 left-[-140px] w-[300px] h-[300px] border-2 border-dashed border-[#c28a34]/40 rounded-full"></div>

            <div class="absolute bottom-10 left-[-100px] w-[220px] h-[220px] border-2 border-dashed border-[#c28a34]/30 rounded-full"></div>

            <div class="absolute bottom-0 right-8 opacity-[0.04] text-[120px] lg:text-[140px] text-white font-bold">
                ♛
            </div>

            <div class="relative z-10 text-center">

                <img src="{{ asset('images/Clothify.png') }}"
                     alt="Clothify Logo"
                     class="w-44 sm:w-56 lg:w-72 mx-auto mb-5 lg:mb-8 rounded-full">

                <h2 class="text-3xl lg:text-4xl font-extrabold mb-3 lg:mb-4">
                    Welcome Back!
                </h2>

                <div class="w-14 h-1 bg-[#c28a34] rounded-full mx-auto mb-4 lg:mb-5"></div>

                <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                    Log in to access your<br>
                    Clothify Fashions account
                </p>

            </div>
        </div>


        <!-- RIGHT SIDE -->
        <div class="bg-white flex flex-col justify-center px-6 sm:px-10 lg:px-14 py-8 lg:py-0">

            <div class="text-center mb-6 lg:mb-8">
                <p class="text-[#b9822c] tracking-[0.35em] lg:tracking-[0.45em] text-xs lg:text-sm font-extrabold uppercase mb-3 lg:mb-4">
                    Welcome Back
                </p>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-[#081f45]">
                    Login
                </h1>

                <p class="text-gray-500 mt-3 lg:mt-4 text-sm lg:text-base leading-relaxed">
                    Enter your credentials to access<br class="hidden sm:block">
                    your Clothify account.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4 lg:space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-[#081f45] mb-2">
                        {{ __('messages.Email') }}
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="Enter your email"
                           class="w-full px-4 lg:px-5 py-3 lg:py-3.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#081f45] mb-2">
                        {{ __('messages.Password') }}
                    </label>

                    <input type="password"
                           name="password"
                           required
                           placeholder="Enter your password"
                           class="w-full px-4 lg:px-5 py-3 lg:py-3.5 rounded-xl border border-gray-200 bg-white text-gray-700 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                    <label class="inline-flex items-center gap-2 text-gray-600 text-sm">
                        <input type="checkbox"
                               name="remember"
                               class="rounded border-gray-300 text-[#c48a32] focus:ring-[#c48a32]">
                        {{ __('messages.Remember Me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm font-semibold text-[#b9822c] hover:text-[#8b5d1d]">
                            {{ __('messages.Forgot Your Password') }}
                        </a>
                    @endif

                </div>

                <button type="submit"
                        class="w-full py-3 lg:py-3.5 rounded-xl bg-gradient-to-r from-[#c48a32] to-[#a66d20] text-white font-extrabold tracking-widest shadow-lg hover:shadow-xl transition">
                    {{ __('messages.Log In') }}
                </button>

            </form>

            @if (Route::has('register'))
                <p class="text-center mt-5 text-gray-500 text-sm lg:text-base">
                    Don’t have an account?
                    <a href="{{ route('register') }}"
                       class="font-bold text-[#b9822c] hover:text-[#8b5d1d]">
                        Register
                    </a>
                </p>
            @endif

            <div class="mt-6 flex items-center justify-center gap-3 lg:gap-4 text-gray-400 tracking-[0.25em] lg:tracking-[0.35em] text-[10px] lg:text-xs font-bold uppercase">
                <span class="w-8 lg:w-10 h-px bg-gray-300"></span>
                Clothify Fashions
                <span class="w-8 lg:w-10 h-px bg-gray-300"></span>
            </div>

        </div>

    </div>

</div>

@endsection
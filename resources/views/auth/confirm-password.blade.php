@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-[#f8f4ec] flex flex-col items-center justify-center px-4 py-6">

    <!-- Top Logo -->
    <div class="mb-4">
        <img src="{{ asset('images/Clothify.png') }}"
             alt="Clothify Fashions"
             class="w-28 sm:w-32 lg:w-36 h-auto mx-auto">
    </div>

    <!-- Main Card -->
    <div class="w-full max-w-[900px] bg-white rounded-[28px] shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

        <!-- Left Side -->
        <div class="relative bg-[#081f45] flex flex-col items-center justify-center text-white px-6 sm:px-10 py-10 overflow-hidden min-h-[320px]">

            <div class="absolute bottom-0 left-[-140px] w-[300px] h-[300px] border-2 border-dashed border-[#c28a34]/40 rounded-full"></div>
            <div class="absolute bottom-10 left-[-100px] w-[220px] h-[220px] border-2 border-dashed border-[#c28a34]/30 rounded-full"></div>

            <div class="absolute bottom-0 right-8 opacity-[0.04] text-[120px] text-white font-bold">
                ♛
            </div>

            <div class="relative z-10 text-center">

                <img src="{{ asset('images/Clothify.png') }}"
                     alt="Clothify Logo"
                     class="w-40 sm:w-48 lg:w-60 mx-auto mb-5 rounded-full">

                <h2 class="text-3xl font-extrabold mb-3">
                    Secure Access
                </h2>

                <div class="w-14 h-1 bg-[#c28a34] rounded-full mx-auto mb-5"></div>

                <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                    Confirm your password<br>
                    before continuing.
                </p>

            </div>
        </div>


        <!-- Right Side -->
        <div class="bg-white flex flex-col justify-center px-6 sm:px-10 lg:px-12 py-8">

            <div class="text-center mb-8">
                <p class="text-[#b9822c] tracking-[0.35em] text-xs font-extrabold uppercase mb-3">
                    Security Check
                </p>

                <h1 class="text-4xl font-extrabold text-[#081f45]">
                    Confirm Password
                </h1>

                <p class="text-gray-500 mt-3 text-sm leading-relaxed">
                    {{ __('messages.secure_area') }}
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                @csrf

                <!-- Password -->
                <div>
                    <label class="block text-sm font-bold text-[#081f45] mb-2">
                        {{ __('messages.password') }}
                    </label>

                    <input type="password"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Enter your password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-[#c48a32] focus:border-[#c48a32] outline-none shadow-sm">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Button -->
                <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#c48a32] to-[#a66d20] text-white font-extrabold tracking-widest shadow-lg hover:shadow-xl transition">
                    {{ __('messages.confirm') }}
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
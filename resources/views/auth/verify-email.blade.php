@extends('layouts.auth')

@section('content')

<div class="min-h-screen bg-[#f8f4ec] flex flex-col items-center justify-center px-4 py-6">

    <div class="mb-4">
        <img src="{{ asset('images/Clothify.png') }}"
             alt="Clothify Fashions"
             class="w-28 sm:w-32 lg:w-36 h-auto mx-auto">
    </div>

    <div class="w-full max-w-[900px] bg-white rounded-[28px] shadow-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">

        <div class="relative bg-[#081f45] flex flex-col items-center justify-center text-white px-6 sm:px-10 py-10 overflow-hidden min-h-[320px]">
            <div class="absolute bottom-0 left-[-140px] w-[300px] h-[300px] border-2 border-dashed border-[#c28a34]/40 rounded-full"></div>
            <div class="absolute bottom-10 left-[-100px] w-[220px] h-[220px] border-2 border-dashed border-[#c28a34]/30 rounded-full"></div>

            <div class="relative z-10 text-center">
                <img src="{{ asset('images/Clothify.png') }}"
                     alt="Clothify Logo"
                     class="w-40 sm:w-48 lg:w-60 mx-auto mb-5 rounded-full">

                <h2 class="text-3xl font-extrabold mb-3">
                    Verify Email
                </h2>

                <div class="w-14 h-1 bg-[#c28a34] rounded-full mx-auto mb-5"></div>

                <p class="text-white/90 text-sm sm:text-base leading-relaxed">
                    Confirm your email to continue<br>
                    using Clothify Fashions.
                </p>
            </div>
        </div>

        <div class="bg-white flex flex-col justify-center px-6 sm:px-10 lg:px-12 py-8">

            <div class="text-center mb-8">
                <p class="text-[#b9822c] tracking-[0.35em] text-xs font-extrabold uppercase mb-3">
                    Email Verification
                </p>

                <h1 class="text-4xl font-extrabold text-[#081f45]">
                    Check Your Inbox
                </h1>

                <p class="text-gray-500 mt-4 text-sm leading-relaxed">
                    {{ __('messages.Verify Email Info') }}
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-5 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm font-semibold">
                    {{ __('messages.Verification Link Sent') }}
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit"
                            class="w-full py-3.5 rounded-xl bg-gradient-to-r from-[#c48a32] to-[#a66d20] text-white font-extrabold tracking-widest shadow-lg hover:shadow-xl transition">
                        {{ __('messages.Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                            class="w-full py-3 rounded-xl border border-gray-200 text-gray-600 font-bold hover:bg-gray-50 transition">
                        {{ __('messages.Log Out') }}
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection
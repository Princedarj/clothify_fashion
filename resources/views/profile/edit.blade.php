@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 transition-colors duration-300">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="mb-10 
            bg-gradient-to-r 
            from-black via-indigo-800 to-purple-900 
            dark:from-gray-900 dark:via-indigo-900 dark:to-black
            text-white rounded-[2rem] p-8 shadow-xl border border-transparent dark:border-gray-800">

            <p class="text-sm uppercase tracking-[0.3em] text-gray-400 dark:text-gray-300 mb-2">
                {{ __('messages.account_center') }}
            </p>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>
                    <h2 class="text-4xl font-extrabold text-white">
                        {{ __('messages.profile_settings') }}
                    </h2>

                    <p class="text-gray-300 dark:text-gray-400 mt-2">
                        {{ __('messages.profile_settings_desc') }}
                    </p>
                </div>

                <div class="flex items-center gap-4 bg-white/10 dark:bg-gray-800/40 border border-white/10 dark:border-gray-700 rounded-2xl px-5 py-4">

                    <div class="w-14 h-14 rounded-full bg-white dark:bg-indigo-600 text-black dark:text-white flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-bold text-white">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-sm text-gray-300 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Content --}}
        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Left Info Card --}}
            <div class="space-y-6">

                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-7">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-5">
                        👤 {{ __('messages.profile_overview') }}
                    </h3>

                    <div class="space-y-4 text-sm">

                        <div class="flex justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ __('messages.name') }}
                            </span>

                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ auth()->user()->name }}
                            </span>
                        </div>

                        <div class="flex justify-between border-b border-gray-200 dark:border-gray-800 pb-3">
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ __('messages.email') }}
                            </span>

                            <span class="font-semibold text-gray-900 dark:text-white">
                                {{ auth()->user()->email }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">
                                {{ __('messages.account') }}
                            </span>

                            <span class="font-semibold text-green-600 dark:text-green-400">
                                {{ __('messages.active') }}
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Security Card --}}
                <div class="bg-black dark:bg-indigo-600 text-white rounded-[2rem] shadow-xl p-7">
                    <h3 class="text-xl font-bold mb-3">
                        🛡️ {{ __('messages.security_tip') }}
                    </h3>

                    <p class="text-gray-300 dark:text-indigo-100 text-sm leading-relaxed">
                        {{ __('messages.security_tip_desc') }}
                    </p>
                </div>

            </div>

            {{-- Forms --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Update Profile --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

                {{-- Update Password --}}
                <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 p-8">
                    @include('profile.partials.update-password-form')
                </div>

                {{-- Delete Account --}}
                <div class="bg-red-50 dark:bg-red-950 rounded-[2rem] shadow-lg border border-red-100 dark:border-red-900 p-8">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
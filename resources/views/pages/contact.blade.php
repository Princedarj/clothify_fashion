@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 mt-20">
    <div class="max-w-6xl mx-auto">

        <div class="bg-gradient-to-r from-black via-indigo-800 to-purple-900 text-white rounded-[2rem] p-10 mb-10 shadow-xl">
            <p class="uppercase tracking-[0.3em] text-sm text-gray-300 mb-3">
                {{ __('messages.support_center') }}
            </p>
            <h1 class="text-4xl font-extrabold">
                {{ __('messages.Contact Us') }}
            </h1>
            <p class="text-gray-300 mt-3">
                {{ __('messages.contact_desc') }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border dark:border-gray-800">
                <div class="text-4xl mb-4">📧</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.email_support') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">support@clothify.com</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border dark:border-gray-800">
                <div class="text-4xl mb-4">📞</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.call_us') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">+91 98765 43210</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border dark:border-gray-800">
                <div class="text-4xl mb-4">📍</div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('messages.store_address') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Ahmedabad, Gujarat, India</p>
            </div>
        </div>

    </div>
</div>

@endsection
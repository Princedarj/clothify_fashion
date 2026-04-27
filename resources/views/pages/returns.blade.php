@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-14 px-4 mt-20">
    <div class="max-w-5xl mx-auto">

        <div class="bg-gradient-to-r from-black via-indigo-800 to-purple-900 text-white rounded-[2rem] p-10 mb-10 shadow-xl">
            <p class="uppercase tracking-[0.3em] text-sm text-gray-300 mb-3">
                {{ __('messages.customer_care') }}
            </p>
            <h1 class="text-4xl font-extrabold">
                {{ __('messages.Return Policy') }}
            </h1>
            <p class="text-gray-300 mt-3">
                {{ __('messages.return_desc') }}
            </p>
        </div>

        <div class="space-y-5">
            <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border dark:border-gray-800">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">🔁 {{ __('messages.easy_return_policy') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-3">{{ __('messages.return_point_1') }}</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-[2rem] p-7 shadow-lg border dark:border-gray-800">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">✅ {{ __('messages.return_condition') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-3">{{ __('messages.return_point_2') }}</p>
            </div>
        </div>

    </div>
</div>

@endsection
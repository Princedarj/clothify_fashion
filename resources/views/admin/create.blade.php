@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">
            {{ __('messages.add_admin') }}
        </h2>

        <a href="{{ route('admin.profile') }}"
           class="text-blue-600 hover:underline">
            ← {{ __('messages.back') }}
        </a>
    </div>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="space-y-4">

            <input type="text" name="name" placeholder="{{ __('messages.name') }}"
                class="w-full border px-3 py-2 rounded">

            <input type="email" name="email" placeholder="{{ __('messages.email') }}"
                class="w-full border px-3 py-2 rounded">

            <input type="text" name="phone" placeholder="{{ __('messages.phone') }}"
                class="w-full border px-3 py-2 rounded">

            <input type="text" name="city" placeholder="{{ __('messages.city') }}"
                class="w-full border px-3 py-2 rounded">

            <input type="password" name="password" placeholder="{{ __('messages.password') }}"
                class="w-full border px-3 py-2 rounded">

        </div>

        <button class="mt-6 w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            {{ __('messages.create_admin') }}
        </button>

    </form>

</div>

@endsection
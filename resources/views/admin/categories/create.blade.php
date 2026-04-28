@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                {{ __('messages.Admin Panel') }}
            </p>

            <h2 class="text-4xl font-extrabold text-white">
                ➕ {{ __('messages.add_category') }}
            </h2>

            <p class="text-slate-300 mt-2">
                {{ __('messages.create_category_subtitle') }}
            </p>
        </div>
    </div>


    <!-- Form Card -->
    <div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-xl border p-8">

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.category_name') }}
                </label>

                <input type="text"
                       name="name"
                       placeholder="{{ __('messages.enter_category_name') }}"   
                       required
                       class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">

                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition font-semibold">
                    ← {{ __('messages.back') }}
                </a>

                <button type="submit"
                        class="flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                    {{ __('messages.save_category') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
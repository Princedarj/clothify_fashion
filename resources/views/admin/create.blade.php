@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex justify-between items-center gap-4">
            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.Admin Panel') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.add_admin') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    {{ __('messages.create_admin_subtitle') }}
                </p>
            </div>
        </div>
    </div>


    <!-- Form Card -->
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl border p-8">

        <form action="{{ route('admin.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.name') }}
                    </label>
                    <input type="text"
                           name="name"
                           placeholder="{{ __('messages.name') }}"
                           required
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.email') }}
                    </label>
                    <input type="email"
                           name="email"
                           placeholder="{{ __('messages.email') }}"
                           required
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.phone') }}
                    </label>
                    <input type="text"
                           name="phone"
                           placeholder="{{ __('messages.phone') }}"
                           maxlength="10"
                           pattern="[0-9]{10}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.city') }}
                    </label>
                    <input type="text"
                           name="city"
                           placeholder="{{ __('messages.city') }}"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.password') }}
                    </label>
                    <input type="password"
                           name="password"
                           placeholder="{{ __('messages.password') }}"
                           required
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

            </div>

            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">

                <a href="{{ route('admin.profile') }}"
                   class="flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition font-semibold">
                    ← {{ __('messages.back') }}
                </a>

                <button type="submit"
                        class="flex items-center justify-center px-6 py-3 bg-emerald-600 text-white rounded-2xl shadow-lg hover:bg-emerald-700 transition font-semibold">
                    {{ __('messages.create_admin') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
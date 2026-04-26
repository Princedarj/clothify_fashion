@extends('layouts.admin')

@section('content')

@if(session('success'))
<div id="popup" class="fixed inset-0 flex items-center justify-center bg-black/50 z-[9999]">
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-96 text-center border">
        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto text-3xl mb-4">
            ✅
        </div>

        <h3 class="text-xl font-extrabold text-gray-800 mb-2">
            Success
        </h3>

        <p class="text-gray-500">
            {{ session('success') }}
        </p>
    </div>
</div>

<script>
    setTimeout(() => {
        window.location.href = "{{ route('admin.dashboard') }}";
    }, 1500);
</script>
@endif


<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-visible">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.Admin Panel') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.admin_profile') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    Manage your admin account information
                </p>
            </div>

            <div class="flex items-center gap-3">

                <!-- Language -->
                <div class="bg-white/15 backdrop-blur-md border border-white/20 rounded-2xl p-1 flex gap-1">
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ app()->getLocale() == 'en' ? 'bg-white text-indigo-700' : 'text-white hover:bg-white/20' }}">
                        EN
                    </a>

                    <a href="{{ route('lang.switch', 'hi') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ app()->getLocale() == 'hi' ? 'bg-white text-indigo-700' : 'text-white hover:bg-white/20' }}">
                        HI
                    </a>

                    <a href="{{ route('lang.switch', 'gu') }}"
                       class="px-4 py-2 rounded-xl text-sm font-bold transition
                       {{ app()->getLocale() == 'gu' ? 'bg-white text-indigo-700' : 'text-white hover:bg-white/20' }}">
                        GU
                    </a>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500/90 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-red-600 transition font-semibold">
                        {{ __('messages.logout') }}
                    </button>
                </form>

            </div>

        </div>
    </div>


    <!-- Profile Card -->
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl border p-8">

        <form action="{{ route('admin.profile.update') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">

            @csrf

            <!-- Profile Image -->
            <div class="flex flex-col items-center text-center">

                <div class="relative">
                    @if(auth()->user()->image)
                        <img src="{{ asset('storage/' . auth()->user()->image) }}"
                             class="h-36 w-36 rounded-full mx-auto object-cover border-4 border-white shadow-xl ring-4 ring-indigo-100">
                    @else
                        <div class="h-36 w-36 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center text-5xl font-extrabold shadow-xl ring-4 ring-indigo-100">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h3 class="text-2xl font-extrabold text-gray-800 mt-4">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-500">
                    {{ auth()->user()->email }}
                </p>

                <div class="mt-5">
                    <input type="file"
                           name="image"
                           accept=".jpg,.jpeg,.png"
                           class="block w-full text-sm text-gray-600
                                  file:mr-4 file:py-3 file:px-5
                                  file:rounded-2xl file:border-0
                                  file:text-sm file:font-bold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                </div>

            </div>


            <!-- Form Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Name -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.name') }}
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ auth()->user()->name }}"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <!-- Email -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.email') }}
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ auth()->user()->email }}"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.phone') }}
                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ auth()->user()->phone }}"
                           maxlength="10"
                           pattern="[0-9]{10}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)"
                           placeholder="Enter 10 digit number"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <!-- City -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.city') }}
                    </label>

                    <input type="text"
                           name="city"
                           value="{{ auth()->user()->city }}"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

                <!-- Password -->
                <div class="md:col-span-2">
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.password') }}
                    </label>

                    <input type="password"
                           name="password"
                           placeholder="Leave blank if you do not want to change password"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

            </div>


            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">

                <a href="{{ route('admin.create') }}"
                   class="flex items-center justify-center bg-emerald-600 text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-emerald-700 transition font-semibold">
                    + {{ __('messages.add_admin') }}
                </a>

                <button type="submit"
                        class="flex items-center justify-center bg-indigo-600 text-white px-6 py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                    {{ __('messages.update_profile') }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection
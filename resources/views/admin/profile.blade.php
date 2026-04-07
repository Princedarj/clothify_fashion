@extends('layouts.admin')

@section('content')

@if(session('success'))
<div id="popup"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 z-50">

    <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">

        <h3 class="text-lg font-semibold text-green-600 mb-2">
            ✅ Success
        </h3>

        <p class="text-gray-600 mb-4">
            {{ session('success') }}
        </p>

    </div>
</div>

<script>
    // After 1.5 sec → redirect to dashboard
    setTimeout(() => {
        window.location.href = "{{ route('admin.dashboard') }}";
    }, 1500);
</script>
@endif

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __('messages.admin_profile') }}
        </h2>

        <div class="flex items-center gap-3">

            <!-- 🌐 Language -->
            <div class="flex items-center gap-2 text-sm">

                <a href="{{ route('lang.switch', 'en') }}"
                class="{{ app()->getLocale() == 'en' ? 'font-bold text-blue-600' : '' }}">
                    EN
                </a>

                <a href="{{ route('lang.switch', 'hi') }}"
                class="{{ app()->getLocale() == 'hi' ? 'font-bold text-blue-600' : '' }}">
                    HI
                </a>

                <a href="{{ route('lang.switch', 'gu') }}"
                class="{{ app()->getLocale() == 'gu' ? 'font-bold text-blue-600' : '' }}">
                    GU
                </a>

            </div>

            <!-- 🔴 Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    {{ __('messages.logout') }}
                </button>
            </form>

        </div>
    </div>

    <!-- Profile Form -->
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Profile Image -->
            <div class="col-span-2 text-center">
                <img src="{{ asset('storage/' . auth()->user()->image) }}"
                     class="h-32 w-32 rounded-full mx-auto mb-3 object-cover">

                <input type="file" name="image" class="mx-auto">
            </div>

            <!-- Name -->
            <div>
                <label class="block font-semibold mb-1">{{ __('messages.name') }}</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Email -->
            <div>
                <label class="block font-semibold mb-1">{{ __('messages.email') }}</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Phone -->
            <div>
                <label class="block font-semibold mb-1">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" 
                value="{{ auth()->user()->phone }}"
                maxlength="10"
                pattern="[0-9]{10}"
                inputmode="numeric"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,10)"
                class="w-full border rounded px-3 py-2"
                placeholder="Enter 10 digit number">
            </div>

            <!-- City -->
            <div>
                <label class="block font-semibold mb-1">{{ __('messages.city') }}</label>
                <input type="text" name="city" value="{{ auth()->user()->city }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <!-- Password -->
            <div class="col-span-2">
                <label class="block font-semibold mb-1">{{ __('messages.password') }}</label>
                <input type="password" name="password"
                    class="w-full border rounded px-3 py-2"
                    placeholder="••••••••">
            </div>

        </div>

        <!-- Buttons -->
        <div class="flex justify-between items-center mt-6">

            <!-- Add Admin -->
            <a href="{{ route('admin.create') }}"
               class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
                + {{ __('messages.add_admin') }}
            </a>

            <!-- Update -->
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                {{ __('messages.update_profile') }}
            </button>

        </div>

    </form>

</div>

@endsection
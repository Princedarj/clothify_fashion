@extends('layouts.user')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">

    <div class="bg-white shadow-lg rounded-xl p-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">
            {{ __('messages.Checkout') }} 🛒
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg border border-green-200">
                {{ __(session('success')) }}
            </div>
        @endif

        <form method="POST" action="{{ route('order.place') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    {{ __('messages.Full Name') }}
                </label>
                <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    {{ __('messages.Email') }}
                </label>
                <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    {{ __('messages.Phone') }}
                </label>
                <input type="text" name="phone" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>

            <!-- Address -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    {{ __('messages.Address') }}
                </label>
                <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required></textarea>
            </div>

            <!-- Pincode -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">
                    {{ __('messages.Pincode') }}
                </label>
                <input type="text" name="pincode" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    {{ __('messages.Place Order') }}
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('messages.Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('messages.Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('messages.Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full"
                type="text"
                name="phone"
                :value="old('phone')" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('messages.City')" />
            <x-text-input id="city" class="block mt-1 w-full"
                type="text"
                name="city"
                :value="old('city')" />
        </div>

        <!-- Preferred Language -->
        <div class="mt-4">
            <x-input-label for="language" :value="__('messages.Preferred Language')" />
            <select id="language" name="language"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="en">{{ __('messages.English') }}</option>
                <option value="hi">{{ __('messages.Hindi') }}</option>
                <option value="gu">{{ __('messages.Gujarati') }}</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('messages.Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('messages.Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                {{ __('messages.Already Registered') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('messages.Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<section class="space-y-6">

    <header>
        <h2 class="text-xl font-semibold text-gray-900">
            {{ __('messages.profile_information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            {{ __('messages.profile_description') }}
        </p>
    </header>

    <!-- Resend Verification Form -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Update Profile Form -->
    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('messages.name') }}
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                   required>

            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                {{ __('messages.email') }}
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                   required>

            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="text-sm text-gray-800">
                        {{ __('messages.email_unverified') }}

                        <button form="send-verification"
                                class="underline text-sm text-indigo-600 hover:text-indigo-800">
                            {{ __('messages.resend_verification') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('messages.verification_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                {{ __('messages.save_changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-green-600 text-sm">
                    {{ __('messages.profile_updated') }}
                </p>
            @endif
        </div>

    </form>

</section>
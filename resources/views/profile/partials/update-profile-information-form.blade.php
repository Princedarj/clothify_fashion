<section class="space-y-6">

    <header>
        <h2 class="text-xl font-semibold text-gray-900">
            Profile Information
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            Update your account's profile information and email address.
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
                Name
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
                Email
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
                        Your email address is unverified.

                        <button form="send-verification"
                                class="underline text-sm text-indigo-600 hover:text-indigo-800">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-green-600 text-sm">
                    Profile updated successfully.
                </p>
            @endif
        </div>

    </form>

</section>
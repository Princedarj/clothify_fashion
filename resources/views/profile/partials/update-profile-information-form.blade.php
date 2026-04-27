<section class="space-y-6">

    {{-- Success Toast --}}
    @if (session('status') === 'profile-updated')
        <div id="successToast"
            class="fixed top-24 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50">
            ✅ {{ __('messages.profile_updated') }}

            <button onclick="document.getElementById('successToast').remove()"
                    class="ml-4 font-bold">
                ×
            </button>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('successToast');
                if (toast) toast.remove();
            }, 3000);
        </script>
    @endif

    {{-- Header --}}
    <header class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
            👤
        </div>

        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                {{ __('messages.profile_information') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                {{ __('messages.profile_description') }}
            </p>
        </div>
    </header>

    {{-- Resend Verification Form --}}
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Update Profile Form --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Name --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.name') }}
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   placeholder="{{ __('messages.name') }}"
                   class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                   required>

            @error('name')
                <p class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.email') }}
            </label>

            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   placeholder="{{ __('messages.email') }}"
                   class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                   required>

            @error('email')
                <p class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror

            {{-- Email Verification --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 bg-yellow-50 dark:bg-yellow-950 border border-yellow-200 dark:border-yellow-900 rounded-2xl p-4">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        ⚠️ {{ __('messages.email_unverified') }}
                    </p>

                    <button form="send-verification"
                            class="mt-3 inline-block text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 underline">
                        {{ __('messages.resend_verification') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600 dark:text-green-400">
                            ✅ {{ __('messages.verification_sent') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Info Box --}}
        <div class="bg-indigo-50 dark:bg-indigo-950 border border-indigo-100 dark:border-indigo-900 rounded-2xl p-4 text-sm text-indigo-700 dark:text-indigo-300">
            ✨ {{ __('messages.profile_description') }}
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit"
                class="inline-flex items-center gap-2 bg-black dark:bg-indigo-600 text-white px-7 py-3 rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-lg transition">
                💾 {{ __('messages.save_changes') }}
            </button>
        </div>

    </form>

</section>
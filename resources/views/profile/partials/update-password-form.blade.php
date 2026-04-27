<section class="space-y-6">

    {{-- SUCCESS TOAST --}}
    @if (session('status') === 'password-updated')
        <div id="successToast"
            class="fixed top-24 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50">
            ✅ {{ __('messages.password_updated') }}
            <button onclick="document.getElementById('successToast').remove()"
                    class="ml-4 font-bold">×</button>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('successToast');
                if (toast) toast.remove();
            }, 3000);
        </script>
    @endif

    {{-- ERROR TOAST --}}
    @if ($errors->updatePassword->any())
        <div id="errorToast"
            class="fixed top-24 right-6 bg-red-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50">
            ⚠️ {{ __('messages.fix_errors') }}
            <button onclick="document.getElementById('errorToast').remove()"
                    class="ml-4 font-bold">×</button>
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('errorToast');
                if (toast) toast.remove();
            }, 3000);
        </script>
    @endif

    <header class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xl">
            🔐
        </div>

        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                {{ __('messages.update_password') }}
            </h2>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                {{ __('messages.password_desc') }}
            </p>
        </div>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.current_password') }}
            </label>

            <input type="password"
                name="current_password"
                placeholder="{{ __('messages.current_password') }}"
                class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                required>

            {{-- Forgot Password --}}
            <div class="mt-3 text-right">
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                    {{ __('messages.forgot_current_password_hint') }}
                </p>
            </div>

            @error('current_password', 'updatePassword')
                <p class="text-red-500 dark:text-red-400 text-sm mt-2">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.new_password') }}
            </label>

            <input type="password"
                   name="password"
                   placeholder="{{ __('messages.new_password') }}"
                   class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                   required>

            @error('password', 'updatePassword')
                <p class="text-red-500 dark:text-red-400 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.confirm_password') }}
            </label>

            <input type="password"
                   name="password_confirmation"
                   placeholder="{{ __('messages.confirm_password') }}"
                   class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                   required>
        </div>

        <div class="bg-indigo-50 dark:bg-indigo-950 border border-indigo-100 dark:border-indigo-900 rounded-2xl p-4 text-sm text-indigo-700 dark:text-indigo-300">
            🛡️ {{ __('messages.security_tip_desc') }}
        </div>

        <div>
            <button type="submit"
                class="inline-flex items-center gap-2 bg-black dark:bg-indigo-600 text-white px-7 py-3 rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-lg transition">
                💾 {{ __('messages.save_changes') }}
            </button>
        </div>

    </form>

</section>
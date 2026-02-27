<section class="space-y-6">

    {{-- SUCCESS TOAST --}}
    @if (session('status') === 'password-updated')
        <div id="successToast"
            class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
            Password updated successfully.
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

    @if ($errors->updatePassword->any())
        <div id="errorToast"
            class="fixed top-6 right-6 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
            Please fix the errors before submitting.
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

    <header>
        <h2 class="text-xl font-semibold text-gray-900">
            Update Password
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Current Password
            </label>
            <input type="password"
                   name="current_password"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                   required>

            @error('current_password', 'updatePassword')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                New Password
            </label>
            <input type="password"
                   name="password"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                   required>

            @error('password', 'updatePassword')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Confirm Password
            </label>
            <input type="password"
                   name="password_confirmation"
                   class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                Save Changes
            </button>

        </div>

    </form>

</section>
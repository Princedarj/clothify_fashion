<section class="space-y-6">

    <header class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-900/40 text-red-600 dark:text-red-400 flex items-center justify-center text-xl">
            ⚠️
        </div>

        <div>
            <h2 class="text-2xl font-extrabold text-red-700 dark:text-red-400">
                {{ __('messages.delete_account') }}
            </h2>

            <p class="mt-2 text-sm text-red-500 dark:text-red-300 leading-relaxed">
                {{ __('messages.delete_account_desc') }}
            </p>
        </div>
    </header>

    <div class="bg-white dark:bg-gray-900 border border-red-100 dark:border-red-900 rounded-2xl p-5">
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
            {{ __('messages.delete_warning') }}
        </p>

        <button type="button" onclick="openDeleteModal()"
            class="inline-flex items-center gap-2 bg-red-600 text-white px-6 py-3 rounded-full font-bold hover:bg-red-700 hover:shadow-lg transition">
            🗑️ {{ __('messages.delete_account') }}
        </button>
    </div>

</section>

<div id="deleteModal"
     class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 px-4">

    <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-2xl w-full max-w-md relative overflow-hidden border border-gray-100 dark:border-gray-800">

        <div class="bg-red-600 dark:bg-red-700 text-white p-6">
            <button type="button" onclick="closeDeleteModal()"
                class="absolute top-5 right-6 text-white/80 hover:text-white text-2xl">
                &times;
            </button>

            <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center text-3xl mb-4">
                ⚠️
            </div>

            <h2 class="text-2xl font-extrabold">
                {{ __('messages.are_you_sure') }}
            </h2>

            <p class="text-sm text-red-100 mt-2">
                {{ __('messages.delete_warning') }}
            </p>
        </div>

        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('DELETE')

            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                {{ __('messages.enter_password') }}
            </label>

            <input type="password"
                name="password"
                placeholder="{{ __('messages.enter_password') }}"
                class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-5 py-3 mb-5 focus:outline-none focus:ring-2 focus:ring-red-500"
                required>

            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="closeDeleteModal()"
                    class="px-5 py-3 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    {{ __('messages.cancel') }}
                </button>

                <button type="submit"
                    class="px-5 py-3 rounded-full bg-red-600 text-white font-bold hover:bg-red-700 hover:shadow-lg transition">
                    {{ __('messages.delete_account') }}
                </button>
            </div>
        </form>

    </div>
</div>
<script>
    function openDeleteModal() {
        const modal = document.getElementById('deleteModal');

        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');

        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>
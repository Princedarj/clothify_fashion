<section class="space-y-6">

    <header>
        <h2 class="text-xl font-semibold text-gray-900">
            Delete Account
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <!-- Delete Button -->
    <button onclick="openDeleteModal()"
        class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition">
        Delete Account
    </button>

</section>

<!-- Delete Confirmation Modal -->
<div id="deleteModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl p-8 w-full max-w-md relative">

        <button onclick="closeDeleteModal()"
            class="absolute top-3 right-4 text-gray-600 text-xl">
            &times;
        </button>

        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Are you sure?
        </h2>

        <p class="text-sm text-gray-600 mb-6">
            This action is permanent. Please enter your password to confirm.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <input type="password"
                name="password"
                placeholder="Enter your password"
                class="w-full border rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-red-500"
                required>

            <div class="flex justify-end gap-3">
                <button type="button"
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                    Delete Account
                </button>
            </div>

        </form>

    </div>
</div>

<script>
function openDeleteModal() {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}
</script>
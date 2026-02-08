<x-app-layout>

    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Checkout</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('order.place') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone" class="w-full border p-2" required>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <textarea name="address" class="w-full border p-2" required></textarea>
            </div>

            <div class="mb-3">
                <label>Pincode</label>
                <input type="text" name="pincode" class="w-full border p-2" required>
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded">
                Place Order
            </button>
        </form>
    </div>

</x-app-layout>

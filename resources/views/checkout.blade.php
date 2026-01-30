<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- LEFT: Address Form -->
        <div class="border p-5 rounded shadow-sm">
            <h2 class="text-lg font-bold mb-3">Delivery Details</h2>

            <form method="POST" action="{{ route('order.place') }}">
                @csrf

                <input type="text" name="name"
                    placeholder="Full Name"
                    class="w-full mb-3 border rounded p-2 text-sm"
                    required>

                <input type="email" name="email"
                    placeholder="Email"
                    class="w-full mb-3 border rounded p-2 text-sm"
                    required>

                <input type="text" name="phone"
                    placeholder="Phone Number"
                    class="w-full mb-3 border rounded p-2 text-sm"
                    required>

                <textarea name="address"
                    placeholder="Full Address"
                    class="w-full mb-3 border rounded p-2 text-sm"
                    rows="3"
                    required></textarea>

                <button class="w-full bg-green-600 text-white py-2 rounded text-sm">
                    Place Order
                </button>
            </form>
        </div>

        <!-- RIGHT: Order Summary -->
        <div class="border p-5 rounded shadow-sm">
            <h2 class="text-lg font-bold mb-3">Order Summary</h2>

            @php $total = 0; @endphp

            @foreach($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp

                <div class="flex justify-between text-sm mb-2">
                    <span>{{ $item['name'] }} (×{{ $item['quantity'] }})</span>
                    <span>₹ {{ $item['price'] * $item['quantity'] }}</span>
                </div>
            @endforeach

            <hr class="my-2">

            <div class="flex justify-between font-bold text-sm">
                <span>Total</span>
                <span>₹ {{ $total }}</span>
            </div>
        </div>

    </div>
</x-app-layout>

<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto">

        <h2 class="text-2xl font-bold mb-6">Checkout 🧾</h2>

        <!-- Delivery Address -->
        <div class="border p-4 rounded mb-6">
            <h3 class="font-semibold mb-2">Delivery Address 📍</h3>

            <p class="text-gray-700">
                <strong>{{ Auth::user()->name }}</strong><br>
                {{ Auth::user()->email }}<br>
                Address will be delivered to registered address.
            </p>
        </div>

        <!-- Order Summary -->
        <div class="border p-4 rounded">
            <h3 class="font-semibold mb-4">Order Summary</h3>

            <table class="w-full border text-center">
                <thead>
                    <tr class="bg-gray-100 border">
                        <th class="p-2">Product</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Qty</th>
                        <th class="p-2">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @php $grandTotal = 0; @endphp

                    @foreach($cart as $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp

                        <tr class="border">
                            <td class="p-2">{{ $item['name'] }}</td>
                            <td class="p-2">₹ {{ $item['price'] }}</td>
                            <td class="p-2">{{ $item['quantity'] }}</td>
                            <td class="p-2">₹ {{ $total }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr class="bg-gray-100 font-bold border">
                        <td colspan="3" class="p-2 text-right">Grand Total</td>
                        <td class="p-2">₹ {{ $grandTotal }}</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Place Order Button -->
            <form method="POST" action="{{ route('order.place') }}" class="text-right mt-6">
                @csrf
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    🚀 Place Order
                </button>
            </form>

        </div>
    </div>
</x-app-layout>

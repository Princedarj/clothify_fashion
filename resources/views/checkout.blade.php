<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        <h2 class="text-2xl font-bold mb-6">Checkout 💳</h2>

        <form method="POST" action="{{ route('order.place') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- LEFT: DELIVERY DETAILS -->
                <div class="border rounded p-4">
                    <h3 class="font-semibold text-lg mb-4">Delivery Details</h3>

                    <div class="mb-3">
                        <label class="text-sm">Full Name</label>
                        <input type="text" name="name" required
                            class="w-full mt-1 border rounded px-3 py-2">
                    </div>

                    <div class="mb-3">
                        <label class="text-sm">Phone</label>
                        <input type="text" name="phone" required
                            class="w-full mt-1 border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="text-sm">Address</label>
                        <textarea name="address" rows="3" required
                            class="w-full mt-1 border rounded px-3 py-2"></textarea>
                    </div>
                </div>

                <!-- RIGHT: ORDER SUMMARY -->
                <div class="border rounded p-4">
                    <h3 class="font-semibold text-lg mb-4">Order Summary</h3>

                    <table class="w-full text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 text-left">Item</th>
                                <th class="p-2">Qty</th>
                                <th class="p-2 text-right">Price</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $total = 0; @endphp

                            @foreach($cart as $item)
                                @php
                                    $sub = $item['price'] * $item['quantity'];
                                    $total += $sub;
                                @endphp
                                <tr class="border-t">
                                    <td class="p-2">{{ $item['name'] }}</td>
                                    <td class="p-2 text-center">{{ $item['quantity'] }}</td>
                                    <td class="p-2 text-right">₹ {{ $sub }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot class="bg-gray-100 font-bold">
                            <tr>
                                <td colspan="2" class="p-2 text-right">Total</td>
                                <td class="p-2 text-right">₹ {{ $total }}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <button
                        class="mt-4 w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
                        Place Order
                    </button>
                </div>

            </div>
        </form>
    </div>
</x-app-layout>

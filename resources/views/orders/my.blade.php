<x-app-layout>
    <div class="py-8 max-w-5xl mx-auto">
        <h2 class="text-xl font-bold mb-4">My Orders 📦</h2>

        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
        <table class="w-full border text-center text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Order ID</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Address</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr class="border">
                    <td class="p-2">#{{ $order->id }}</td>
                    <td class="p-2">₹ {{ $order->total_amount }}</td>
                    <td class="p-2 font-semibold">
                        {{ $order->status }}
                    </td>
                    <td class="p-2">{{ $order->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>

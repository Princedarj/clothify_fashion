<x-app-layout>
    <div class="py-8 max-w-6xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Admin Orders 📦</h2>

        <table class="w-full border text-center text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Order ID</th>
                    <th class="p-2">Customer</th>
                    <th class="p-2">Address</th>
                    <th class="p-2">Total</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                <tr class="border">
                    <td class="p-2">#{{ $order->id }}</td>
                    <td class="p-2">{{ $order->name }}</td>
                    <td class="p-2">{{ $order->address }}</td>
                    <td class="p-2">₹ {{ $order->total_amount }}</td>
                    <td class="p-2 font-semibold">{{ $order->status }}</td>

                    <td class="p-2 space-y-2">

    <!-- ✅ View Button -->
    <a href="{{ route('admin.orders.show', $order->id) }}"
       class="bg-blue-600 text-white px-3 py-1 rounded text-xs inline-block">
        View
    </a>

    <!-- ✅ Deliver Button -->
    @if($order->status != 'Delivered')
        <form method="POST" action="{{ route('order.deliver', $order->id) }}">
            @csrf
            <button class="bg-green-600 text-white px-3 py-1 rounded text-xs">
                Mark Delivered
            </button>
        </form>
    @else
        <span class="text-green-600 font-bold text-xs">Delivered</span>
    @endif

</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

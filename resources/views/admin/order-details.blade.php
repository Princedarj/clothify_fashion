<x-app-layout>

    <div class="max-w-6xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">
            Order Details (Order #{{ $order->id }})
        </h1>

        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-lg font-semibold mb-3">Customer Info</h2>

            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>
            <p>
                <strong>Status:</strong>
                <span class="px-3 py-1 rounded 
                    {{ $order->status == 'Delivered' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                        {{ $order->status == 'Delivered' 
                            ? 'bg-green-100 text-green-700' 
                            : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $order->status }}
                    </span>

                </span>
            </p>
            @if($order->status != 'Delivered')
    <form method="POST" action="{{ route('admin.orders.deliver', $order->id) }}" class="mt-4">
        @csrf
        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Mark as Delivered
        </button>
        <td class="p-2">
    <a href="{{ route('user.orders.invoice', $order->id) }}"
       class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
        Download Invoice
    </a>
</td>


    </form>
@endif

        </div>

        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-3">Ordered Products</h2>

            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Price</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="p-2 border">{{ $item->product_name }}</td>
                            <td class="p-2 border">₹{{ $item->price }}</td>
                            <td class="p-2 border">{{ $item->quantity }}</td>
                            <td class="p-2 border">₹{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>

</x-app-layout>

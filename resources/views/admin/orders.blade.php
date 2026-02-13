<x-app-layout>
    <div class="py-8 max-w-6xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Admin Orders 📦</h2>

        <form method="GET" class="mb-4 flex gap-4">

            <input type="text" name="search"
                placeholder="Search customer..."
                value="{{ request('search') }}"
                class="border p-2 rounded">

            <select name="status" class="border p-2 rounded">
                <option value="">All Status</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
            </select>

            <select name="date" class="border p-2 rounded">
                <option value="">All Dates</option>
                <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>This Month</option>
            </select>

            <button class="bg-black text-white px-4 py-2 rounded">
                Filter
            </button>
            
            <a href="{{ route('admin.orders.export', request()->query()) }}"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Export Excel
            </a>

        </form>

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
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-white text-xs
                            @if($order->status == 'Delivered') bg-green-500
                            @elseif($order->status == 'Pending') bg-yellow-500
                            @else bg-gray-500
                            @endif">
                            {{ $order->status }}
                        </span>
                    </td>


                    <td class="p-2 space-y-2">

                        <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded text-xs inline-block">
                            View
                        </a>

                        <a href="{{ route('admin.orders.invoice', $order->id) }}"
                        class="bg-purple-600 text-white px-3 py-1 rounded text-xs inline-block">
                            Invoice
                        </a>

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
        <div class="mt-4">
            {{ $orders->links() }}
        </div>

    </div>
</x-app-layout>

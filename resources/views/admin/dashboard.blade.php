@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Admin Dashboard 📊</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Total Orders -->
    <div class="bg-blue-500 text-white p-6 rounded shadow">
        <h3 class="text-lg">Total Orders</h3>
        <p class="text-3xl font-bold">{{ $totalOrders }}</p>
    </div>

    <!-- Total Revenue -->
    <div class="bg-green-500 text-white p-6 rounded shadow">
        <h3 class="text-lg">Total Revenue</h3>
        <p class="text-3xl font-bold">₹{{ $totalRevenue }}</p>
    </div>

    <!-- Total Users -->
    <div class="bg-purple-500 text-white p-6 rounded shadow">
        <h3 class="text-lg">Total Users</h3>
        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
    </div>

    <!-- Pending Orders -->
    <div class="bg-red-500 text-white p-6 rounded shadow">
        <h3 class="text-lg">Pending Orders</h3>
        <p class="text-3xl font-bold">{{ $pendingOrders }}</p>
    </div>

</div>

<div class="bg-white p-6 rounded shadow mt-8">
    <h3 class="text-lg font-bold mb-4">Monthly Revenue</h3>
    <canvas id="salesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($monthlySales->toArray())) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode(array_values($monthlySales->toArray())) !!},
                borderWidth: 1
            }]
        }
    });
</script>
<div class="bg-white p-6 rounded shadow mt-8">
    <h3 class="text-lg font-bold mb-4">Recent Orders</h3>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">#</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $order->id }}</td>
                        <td class="p-3">{{ $order->name }}</td>
                        <td class="p-3">₹{{ $order->total_amount }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 text-sm rounded
                                {{ $order->status == 'Delivered' 
                                   ? 'bg-green-100 text-green-700' 
                                   : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="p-3">
                            {{ $order->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">
                            No recent orders
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
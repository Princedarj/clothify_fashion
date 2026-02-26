@extends('layouts.admin')

@section('content')

<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Dashboard Overview</h2>
    <p class="text-gray-500">Clothify Performance Summary</p>
</div>

<!-- KPI CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">

    <!-- Revenue -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm uppercase opacity-80">Total Revenue</p>
                <h3 class="text-2xl font-bold mt-2">₹{{ number_format($totalRevenue) }}</h3>
                <p class="text-xs mt-2 
                    {{ $growthPercentage >= 0 ? 'text-green-500' : 'text-red-500'}}">
                    
                    {{ $growthPercentage >= 0 ? '▲' : '▼' }}
                    {{ abs($growthPercentage) }}% from last month
                </p>
            </div>
            <div class="text-4xl opacity-30">💰</div>
        </div>
    </div>

    <!-- Orders -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">Total Orders</p>
                <h3 class="text-2xl font-bold mt-2">{{ $totalOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">🛒</div>
        </div>
    </div>

    <!-- Delivered -->
    <div class="bg-gradient-to-r from-green-400 to-emerald-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">Delivered</p>
                <h3 class="text-2xl font-bold mt-2">{{ $deliveredOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">✅</div>
        </div>
    </div>

    <!-- Pending -->
    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">Pending</p>
                <h3 class="text-2xl font-bold mt-2">{{ $pendingOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">⏳</div>
        </div>
    </div>

    <!-- Products -->
    <div class="bg-gradient-to-r from-pink-500 to-rose-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">Products</p>
                <h3 class="text-2xl font-bold mt-2">{{ $totalProducts }}</h3>
            </div>
            <div class="text-4xl opacity-30">👕</div>
        </div>
    </div>

</div>

<!-- CHART SECTION -->
<div class="bg-gradient-to-r from-white to-gray-50 p-8 rounded-2xl shadow-xl mb-10 border">
    <h3 class="text-xl font-semibold mb-6 text-gray-700">Sales Analytics</h3>
    <canvas id="salesChart" height="100"></canvas>
</div>

<!-- RECENT ORDERS -->
<div class="bg-white p-8 rounded-2xl shadow-xl">
    <h3 class="text-xl font-semibold mb-6 text-gray-700">Recent Orders</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 uppercase text-xs">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">Customer</th>
                    <th class="p-4 text-left">Amount</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4 font-semibold text-gray-700">{{ $order->id }}</td>
                    <td class="p-4">{{ $order->name }}</td>
                    <td class="p-4 font-medium text-gray-800">₹{{ number_format($order->total_amount) }}</td>
                    <td class="p-4">
                        @if($order->status == 'Delivered')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Delivered
                            </span>
                        @elseif($order->status == 'Pending')
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Cancelled
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-gray-500">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($monthlySales->keys()) !!},
        datasets: [{
            label: 'Revenue',
            data: {!! json_encode($monthlySales->values()) !!},
            borderColor: '#7c3aed',
            backgroundColor: 'rgba(124,58,237,0.15)',
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointBackgroundColor: '#7c3aed'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        }
    }
});
</script>

@endsection
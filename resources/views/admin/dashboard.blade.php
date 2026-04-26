@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-8">

    <!-- LEFT SIDE -->
    <div>
        <h2 class="text-3xl font-bold text-gray-800">
            {{ __('messages.dashboard') }}
        </h2>
        <p class="text-gray-500">
            {{ __('messages.performance_summary') }}
        </p>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center space-x-3">

        <!-- 🌐 LANGUAGE -->
        <div class="relative">
            <button onclick="toggleLangDropdown()" 
                class="bg-white px-4 py-2 rounded-lg shadow flex items-center space-x-2 hover:bg-gray-100 transition">

                🌐 
                <span class="text-sm font-medium">Language</span>
            </button>

            <div id="langDropdown" 
                class="hidden absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg z-50">

                <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">English</a>
                <a href="{{ route('lang.switch', 'gu') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Gujarati</a>
                <a href="{{ route('lang.switch', 'hi') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Hindi</a>
            </div>
        </div>

        <!-- 🚪 LOGOUT BUTTON -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">
                Logout
            </button>
        </form>

    </div>

</div>

<!-- KPI CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">

    <!-- Revenue -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm uppercase opacity-80">{{ __('messages.total_revenue') }}</p>
                <h3 class="text-2xl font-bold mt-2">₹{{ number_format($totalRevenue) }}</h3>
                <p class="text-xs mt-2
                    @if($growthPercentage > 0)
                        text-green-500
                    @elseif($growthPercentage < 0)
                        text-red-500
                    @else
                        text-gray-400
                    @endif
                ">

                    @if($growthPercentage > 0)
                        ▲ {{ $growthPercentage }}{{ __('messages.percent_last_month') }}
                    @elseif($growthPercentage < 0)
                        ▼ {{ abs($growthPercentage) }}{{ __('messages.percent_last_month') }}
                    @else
                        — {{ __('messages.no_change') }}
                    @endif
                </p>
            </div>
            <div class="text-4xl opacity-30">💰</div>
        </div>
    </div>

    <!-- Orders -->
    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">{{ __('messages.total_orders') }}</p>
                <h3 class="text-2xl font-bold mt-2">{{ $totalOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">🛒</div>
        </div>
    </div>

    <!-- Delivered -->
    <div class="bg-gradient-to-r from-green-400 to-emerald-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">{{ __('messages.delivered') }}</p>
                <h3 class="text-2xl font-bold mt-2">{{ $deliveredOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">✅</div>
        </div>
    </div>

    <!-- Pending -->
    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">{{ __('messages.pending') }}</p>
                <h3 class="text-2xl font-bold mt-2">{{ $pendingOrders }}</h3>
            </div>
            <div class="text-4xl opacity-30">⏳</div>
        </div>
    </div>

    <!-- Products -->
    <div class="bg-gradient-to-r from-pink-500 to-rose-600 text-white p-6 rounded-2xl shadow-xl">
        <div class="flex justify-between">
            <div>
                <p class="text-sm uppercase opacity-80">{{ __('messages.products') }}</p>
                <h3 class="text-2xl font-bold mt-2">{{ $totalProducts }}</h3>
            </div>
            <div class="text-4xl opacity-30">👕</div>
        </div>
    </div>

</div>

<!-- CHART SECTION -->
<div class="bg-gradient-to-r from-white to-gray-50 p-8 rounded-2xl shadow-xl mb-10 border">
    <h3 class="text-xl font-semibold mb-6 text-gray-700">{{ __('messages.sales_analytics') }}</h3>
    <canvas id="salesChart" height="100"></canvas>
</div>

<!-- RECENT ORDERS -->
<div class="bg-white p-8 rounded-2xl shadow-xl">
    <h3 class="text-xl font-semibold mb-6 text-gray-700">{{ __('messages.recent_orders') }}</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-600 uppercase text-xs">
                    <th class="p-4 text-left">#</th>
                    <th class="p-4 text-left">{{ __('messages.customer') }}</th>
                    <th class="p-4 text-left">{{ __('messages.amount') }}</th>
                    <th class="p-4 text-left">{{ __('messages.status') }}</th>
                    <th class="p-4 text-left">{{ __('messages.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-4 font-semibold text-gray-700">{{ $order->id }}</td>
                    <td class="p-4">{{ $order->name }}</td>
                    <td class="p-4 font-medium text-gray-800">₹{{ number_format($order->grand_total ?? $order->total_amount ?? 0) }}</td>
                    <td class="p-4">
                        @if($order->status == 'Delivered')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                {{ __('messages.delivered') }}
                            </span>
                        @elseif($order->status == 'Pending')
                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                {{ __('messages.pending') }}
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                {{ __('messages.cancelled') }}
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
            label: '{{ __("messages.revenue") }}',
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

<script>
function toggleLangDropdown() {
    document.getElementById("langDropdown").classList.toggle("hidden");
}
</script>

@endsection
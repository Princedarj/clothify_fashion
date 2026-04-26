@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl">

        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

            <!-- LEFT SIDE -->
            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.performance_summary') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.dashboard') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    Welcome back, Admin 👋
                </p>
            </div>

            <!-- RIGHT SIDE -->
            <div class="flex items-center gap-3">

                <!-- LANGUAGE -->
                <div class="relative">
                    <button onclick="toggleLangDropdown()"
                        class="bg-white/15 backdrop-blur-md border border-white/20 text-white px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2 hover:bg-white/25 transition">

                        <span>🌐</span>
                        <span class="text-sm font-semibold">Language</span>
                    </button>

                    <div id="langDropdown"
                       class="hidden absolute right-0 mt-3 w-40 bg-white rounded-2xl shadow-2xl z-[999] border">

                        <a href="{{ route('lang.switch', 'en') }}"
                           class="block px-5 py-3 text-sm hover:bg-indigo-50 text-gray-700 rounded-2xl">
                            English
                        </a>

                        <a href="{{ route('lang.switch', 'gu') }}"
                           class="block px-5 py-3 text-sm hover:bg-indigo-50 text-gray-700 rounded-2xl">
                            Gujarati
                        </a>

                        <a href="{{ route('lang.switch', 'hi') }}"
                           class="block px-5 py-3 text-sm hover:bg-indigo-50 text-gray-700 rounded-2xl">
                            Hindi
                        </a>
                    </div>
                </div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500/90 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-red-600 transition font-semibold">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>


    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

        <!-- Revenue -->
        <div class="group relative overflow-hidden bg-white p-6 rounded-3xl shadow-xl border hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-100 rounded-full blur-2xl"></div>

            <div class="relative">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs uppercase tracking-widest text-gray-500 font-bold">
                            {{ __('messages.total_revenue') }}
                        </p>

                        <h3 class="text-3xl font-extrabold text-gray-900 mt-3">
                            ₹{{ number_format($totalRevenue) }}
                        </h3>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl shadow-lg">
                        💰
                    </div>
                </div>

                <p class="text-sm mt-5 font-semibold
                    @if($growthPercentage > 0)
                        text-green-600
                    @elseif($growthPercentage < 0)
                        text-red-600
                    @else
                        text-gray-500
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
        </div>


        <!-- Orders -->
        <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-xl border hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-32 h-32 bg-blue-100 rounded-full blur-2xl"></div>

            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-500 font-bold">
                        {{ __('messages.total_orders') }}
                    </p>

                    <h3 class="text-3xl font-extrabold text-gray-900 mt-3">
                        {{ $totalOrders }}
                    </h3>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    🛒
                </div>
            </div>
        </div>


        <!-- Delivered -->
        <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-xl border hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-32 h-32 bg-green-100 rounded-full blur-2xl"></div>

            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-500 font-bold">
                        {{ __('messages.delivered') }}
                    </p>

                    <h3 class="text-3xl font-extrabold text-gray-900 mt-3">
                        {{ $deliveredOrders }}
                    </h3>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-green-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    ✅
                </div>
            </div>
        </div>


        <!-- Pending -->
        <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-xl border hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-32 h-32 bg-yellow-100 rounded-full blur-2xl"></div>

            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-500 font-bold">
                        {{ __('messages.pending') }}
                    </p>

                    <h3 class="text-3xl font-extrabold text-gray-900 mt-3">
                        {{ $pendingOrders }}
                    </h3>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-yellow-500 text-white flex items-center justify-center text-2xl shadow-lg">
                    ⏳
                </div>
            </div>
        </div>


        <!-- Products -->
        <div class="relative overflow-hidden bg-white p-6 rounded-3xl shadow-xl border hover:-translate-y-1 transition duration-300">
            <div class="absolute right-0 top-0 w-32 h-32 bg-pink-100 rounded-full blur-2xl"></div>

            <div class="relative flex justify-between items-start">
                <div>
                    <p class="text-xs uppercase tracking-widest text-gray-500 font-bold">
                        {{ __('messages.products') }}
                    </p>

                    <h3 class="text-3xl font-extrabold text-gray-900 mt-3">
                        {{ $totalProducts }}
                    </h3>
                </div>

                <div class="w-14 h-14 rounded-2xl bg-pink-600 text-white flex items-center justify-center text-2xl shadow-lg">
                    👕
                </div>
            </div>
        </div>

    </div>


    <!-- CHART SECTION -->
    <div class="bg-white p-8 rounded-3xl shadow-xl border">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h3 class="text-2xl font-extrabold text-gray-800">
                    {{ __('messages.sales_analytics') }}
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Monthly revenue performance overview
                </p>
            </div>

            <div class="px-5 py-2 rounded-full bg-indigo-50 text-indigo-700 text-sm font-bold">
                {{ __('messages.revenue') }}
            </div>
        </div>

        <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 rounded-3xl p-6">
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>


    <!-- RECENT ORDERS -->
    <div class="bg-white p-8 rounded-3xl shadow-xl border">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h3 class="text-2xl font-extrabold text-gray-800">
                    {{ __('messages.recent_orders') }}
                </h3>

                <p class="text-sm text-gray-500 mt-1">
                    Latest customer order details
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-2xl border">
            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-slate-900 text-white uppercase text-xs tracking-wider">
                        <th class="p-5 text-left">#</th>
                        <th class="p-5 text-left">{{ __('messages.customer') }}</th>
                        <th class="p-5 text-left">{{ __('messages.amount') }}</th>
                        <th class="p-5 text-left">{{ __('messages.status') }}</th>
                        <th class="p-5 text-left">{{ __('messages.date') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach($recentOrders as $order)
                    <tr class="hover:bg-indigo-50/60 transition duration-200">

                        <td class="p-5 font-bold text-gray-800">
                            #{{ $order->id }}
                        </td>

                        <td class="p-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($order->name, 0, 1)) }}
                                </div>

                                <span class="font-semibold text-gray-700">
                                    {{ $order->name }}
                                </span>
                            </div>
                        </td>

                        <td class="p-5 font-bold text-gray-900">
                            ₹{{ number_format($order->grand_total ?? $order->total_amount ?? 0) }}
                        </td>

                        <td class="p-5">
                            @if($order->status == 'Delivered')
                                <span class="inline-flex items-center gap-2 px-4 py-2 text-xs rounded-full bg-green-100 text-green-700 font-bold">
                                    ● {{ __('messages.delivered') }}
                                </span>
                            @elseif($order->status == 'Pending')
                                <span class="inline-flex items-center gap-2 px-4 py-2 text-xs rounded-full bg-yellow-100 text-yellow-700 font-bold">
                                    ● {{ __('messages.pending') }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-4 py-2 text-xs rounded-full bg-red-100 text-red-700 font-bold">
                                    ● {{ __('messages.cancelled') }}
                                </span>
                            @endif
                        </td>

                        <td class="p-5 text-gray-500 font-medium">
                            {{ $order->created_at->format('d M Y') }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
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
            borderColor: '#4f46e5',
            backgroundColor: 'rgba(79, 70, 229, 0.15)',
            fill: true,
            tension: 0.45,
            borderWidth: 4,
            pointBackgroundColor: '#4f46e5',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 3,
            pointRadius: 6,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: '#374151',
                    font: {
                        weight: 'bold'
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#6b7280'
                }
            },
            y: {
                grid: {
                    color: 'rgba(156, 163, 175, 0.25)'
                },
                ticks: {
                    color: '#6b7280'
                }
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
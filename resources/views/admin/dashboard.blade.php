<x-app-layout>
<div class="py-8 max-w-6xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Admin Dashboard 📊</h2>

    <div class="grid grid-cols-4 gap-6">

        <div class="bg-blue-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Total Orders</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
        </div>

        <div class="bg-green-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Total Revenue</h3>
            <p class="text-3xl font-bold mt-2">₹{{ $totalRevenue }}</p>
        </div>

        <div class="bg-purple-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Total Users</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
        </div>

        <div class="bg-red-500 text-white p-6 rounded shadow">
            <h3 class="text-lg">Pending Orders</h3>
            <p class="text-3xl font-bold mt-2">{{ $pendingOrders }}</p>
        </div>

    </div>
    <div class="bg-white p-6 rounded shadow mt-8">
    <h3 class="text-lg font-bold mb-4">Monthly Revenue</h3>
    <canvas id="salesChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($monthlySales->toArray())) !!},
            datasets: [{
                label: 'Revenue',
                data: {!! json_encode(array_values($monthlySales->toArray())) !!},
                borderWidth: 1
            }]
        },
    });
</script>


</div>
</x-app-layout>

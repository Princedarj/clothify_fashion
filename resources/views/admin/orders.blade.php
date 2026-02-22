@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-xl shadow-md p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                Orders Management
            </h2>
        </div>

        <form method="GET" class="flex gap-3 mb-4">

    <input type="text" name="search"
        placeholder="Search ID or Customer"
        value="{{ request('search') }}"
        class="border px-3 py-2 rounded">

    <select name="status" class="border px-7 py-2 rounded">
        <option value="">All Status</option>
        <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
        <option value="Delivered" {{ request('status')=='Delivered'?'selected':'' }}>Delivered</option>
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Filter
    </button>

    <a href="{{ route('admin.orders.export') }}"
       class="bg-green-600 text-white px-4 py-2 rounded">
       Export
    </a>

</form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
            <th class="p-3">
                <a href="?sort=id&direction={{ request('direction')=='asc'?'desc':'asc' }}">
                    Order ID
                </a>
            </th>
            <th class="p-3">Customer</th>
            <th class="p-3">
                <a href="?sort=total_amount&direction={{ request('direction')=='asc'?'desc':'asc' }}">
                    Total
                </a>
            </th>
            <th class="p-3">Status</th>
            <th class="p-3">
                <a href="?sort=created_at&direction={{ request('direction')=='asc'?'desc':'asc' }}">
                    Date
                </a>
            </th>
            <th class="p-3">Action</th>
        </tr>
    </thead>

    <tbody>
            @if($orders->count() > 0)

                @foreach($orders as $order)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $order->id }}</td>
                    <td class="p-3">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="p-3">₹ {{ number_format($order->total_amount ?? 0) }}</td>
                    <td class="p-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            {{ $order->status == 'Delivered' ? 'bg-green-100 text-green-700' :
                            ($order->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                            'bg-gray-100 text-gray-700') }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-3">
                        {{ $order->created_at->format('d M Y') }}
                    </td>
                    <td class="p-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="text-indigo-600 hover:underline">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach

            @elseif(request()->search)

                <tr>
                    <td colspan="6" class="text-center p-6 text-red-600 font-semibold">
                        No matching name or number found in database.
                    </td>
                </tr>

            @else

                <tr>
                    <td colspan="6" class="text-center p-6 text-gray-500">
                        No orders available.
                    </td>
                </tr>

            @endif
        </tbody>  <!-- ✅ PROPER CLOSE -->
</table>
        </div>

    </div>
</div>
{{ $orders->links() }}

@endsection
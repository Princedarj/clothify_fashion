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

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
            <th class="p-3">Order ID</th>
            <th class="p-3">Customer</th>
            <th class="p-3">Total</th>
            <th class="p-3">Status</th>
            <th class="p-3">Date</th>
            <th class="p-3">Action</th>
        </tr>
    </thead>

    <tbody>   <!-- ✅ ADD THIS -->
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
    </tbody>   <!-- ✅ PROPER CLOSE -->
</table>
        </div>

    </div>
</div>
{{ $orders->links() }}
@endsection
@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Orders Management</h1>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Customer</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Total</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">

            @foreach($orders as $order)
            <tr>
                <td class="px-6 py-4">{{ $order->id }}</td>
                <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
                <td class="px-6 py-4">Rs. {{ $order->total_amount }}</td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 text-sm rounded
                        {{ $order->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $order->status == 'Shipped' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $order->status == 'Delivered' ? 'bg-green-100 text-green-700' : '' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="px-6 py-4">{{ $order->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                        class="text-indigo-600 hover:underline">
                        View
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>

@endsection
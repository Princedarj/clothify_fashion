@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Users Management 👥</h2>

<div class="bg-blue-500 text-white p-6 rounded shadow mb-6">
    <h3 class="text-lg">Total Users</h3>
    <p class="text-3xl font-bold">{{ $totalUsers }}</p>
</div>

<div class="bg-white p-6 rounded shadow">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">#</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">City</th>
                    <th class="p-3">Total Orders</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $user->id }}</td>
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">{{ $user->phone ?? 'N/A' }}</td>
                        <td class="p-3">{{ $user->city ?? 'N/A' }}</td>
                        <td class="p-3 font-bold">
                            {{ $user->orders_count }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">
                            No users found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

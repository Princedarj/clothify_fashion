@extends('layouts.admin')

@section('content')

    <div class="flex justify-between items-center mb-6">

        <!-- Left: Title -->
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <span>👥</span>
            <span>Users Management</span>
        </h2>

        <!-- Right: Language + Logout -->
        <div class="flex items-center gap-3">

            <!-- 🌐 Language -->
            <div class="relative flex items-center">

                <button onclick="toggleLangDropdown()" 
                    class="bg-gray-100 px-4 py-2 flex items-center rounded-lg shadow hover:bg-gray-200">

                    <span class="flex items-center gap-2 leading-none">
                        <span>🌐</span>
                        <span>{{ __('messages.language') }}</span>
                    </span>

                </button>

                <div id="langDropdown" 
                    class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-32 z-50">

                    <a href="{{ route('lang.switch', 'en') }}" 
                    class="block px-4 py-2 hover:bg-gray-100">English</a>

                    <a href="{{ route('lang.switch', 'hi') }}" 
                    class="block px-4 py-2 hover:bg-gray-100">हिंदी</a>

                    <a href="{{ route('lang.switch', 'gu') }}" 
                    class="block px-4 py-2 hover:bg-gray-100">ગુજરાતી</a>
                </div>

            </div>

            <!--  Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 flex items-center rounded-lg hover:bg-red-600 leading-none">

                    <span class="flex items-center gap-2">
                        <span>{{ __('messages.logout') }}</span>
                    </span>

                </button>
            </form>

        </div>

    </div>

<div class="bg-blue-500 text-white p-6 rounded shadow mb-6">
    <h3 class="text-lg">Total Users</h3>
    <p class="text-3xl font-bold">{{ $totalUsers }}</p>
</div>

<div class="bg-white p-6 rounded shadow">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">User ID</th>
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

<script>
function toggleLangDropdown() {
    document.getElementById('langDropdown').classList.toggle('hidden');
}
</script>
@endsection

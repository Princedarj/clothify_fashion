<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 opacity-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-6 flex flex-col justify-between">

        <!-- Top Section -->
        <div>
            <h2 class="text-2xl font-bold mb-6">Clothify Admin</h2>

            <nav class="space-y-3">

                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded 
                   {{ request()->is('admin/dashboard*') 
                      ? 'bg-gray-700 text-white' 
                      : 'hover:bg-gray-700' }}">
                   📊 Dashboard
                </a>

                <a href="{{ route('admin.orders') }}"
                   class="block px-4 py-2 rounded 
                   {{ request()->is('admin/orders*') 
                      ? 'bg-gray-700 text-white' 
                      : 'hover:bg-gray-700' }}">
                   📦 Orders
                </a>

                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                   👕 Products
                </a>

                <a href="#" class="block px-4 py-2 rounded hover:bg-gray-700">
                   👥 Users
                </a>

            </nav>
        </div>

        <!-- Bottom Section -->
        <div class="pt-6 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-4 py-2 rounded w-full hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</div>

</body>
</html>
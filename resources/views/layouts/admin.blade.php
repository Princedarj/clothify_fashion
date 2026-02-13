<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-6 space-y-6">

        <h2 class="text-2xl font-bold">Clothify Admin</h2>

        <nav class="space-y-3">

            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-2 rounded 
                {{ request()->fullUrlIs('*admin/dashboard*') 
                    ? 'bg-gray-700 text-white' 
                    : 'hover:bg-gray-700' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('admin.orders') }}"
                class="block px-4 py-2 rounded 
                {{ request()->fullUrlIs('*admin/orders*') 
                    ? 'bg-gray-700 text-white' 
                    : 'hover:bg-gray-700' }}">
                📦 Orders
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-700">
               👕 Products
            </a>

            <a href="#"
               class="block px-4 py-2 rounded hover:bg-gray-700">
               👥 Users
            </a>

        </nav>

        <div>
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
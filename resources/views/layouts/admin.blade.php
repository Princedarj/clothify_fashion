<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.Admin Panel') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-900 text-white p-6 flex flex-col justify-between">

        <!-- Top Section -->
        <div>
            <h2 class="text-2xl font-bold mb-6">
                {{ __('messages.Clothify Admin') }}
            </h2>

            <nav class="space-y-3">

                <a href="{{ route('admin.dashboard') }}"
                   class="block px-4 py-2 rounded 
                   {{ request()->is('admin/dashboard*') 
                      ? 'bg-gray-700 text-white' 
                      : 'hover:bg-gray-700' }}">
                   📊 {{ __('messages.dashboard') }}
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="block px-4 py-2 rounded 
                   {{ request()->is('admin/orders*') 
                      ? 'bg-gray-700 text-white' 
                      : 'hover:bg-gray-700' }}">
                   📦 {{ __('messages.orders') }}
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="block px-4 py-2 rounded 
                    {{ request()->is('admin/products*') 
                        ? 'bg-gray-700 text-white' 
                        : 'hover:bg-gray-700' }}">
                    👕 {{ __('messages.products') }}
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="block px-4 py-2 rounded 
                    {{ request()->is('admin/users*') 
                        ? 'bg-gray-700 text-white' 
                        : 'hover:bg-gray-700' }}">
                    👥 {{ __('messages.users') }}
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="block px-4 py-2 rounded 
                    {{ request()->is('admin/categories*') 
                        ? 'bg-gray-700 text-white' 
                        : 'hover:bg-gray-700' }}">
                    🗂️ {{ __('messages.categories') }}
                </a>

            </nav>
        </div>

        <!--Languages-->

        <div class="pt-6 border-t border-gray-700">

            <p class="text-xs uppercase text-gray-400 mb-3 tracking-wide flex items-center gap-2">
                🌐 {{ __('messages.Language') }}
            </p>

            <div class="grid grid-cols-3 gap-2">

                <a href="{{ route('lang.switch', 'en') }}"
                class="text-center py-2 rounded-lg text-sm font-medium transition
                {{ app()->getLocale() == 'en' 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-gray-800 hover:bg-gray-700 text-gray-300' }}">
                    {{ __('messages.EN') }}
                </a>

                <a href="{{ route('lang.switch', 'gu') }}"
                class="text-center py-2 rounded-lg text-sm font-medium transition
                {{ app()->getLocale() == 'gu' 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-gray-800 hover:bg-gray-700 text-gray-300' }}">
                    {{ __('messages.GU') }}
                </a>

                <a href="{{ route('lang.switch', 'hi') }}"
                class="text-center py-2 rounded-lg text-sm font-medium transition
                {{ app()->getLocale() == 'hi' 
                    ? 'bg-blue-600 text-white' 
                    : 'bg-gray-800 hover:bg-gray-700 text-gray-300' }}">
                    {{ __('messages.HI') }}
                </a>

            </div>

        </div>

        <!-- Bottom Section -->
        <div class="pt-6 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 px-4 py-2 rounded w-full hover:bg-red-700 transition">
                    {{ __('messages.logout') }}
                </button>
            </form>
        </div>

    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 bg-gray-100">
        @yield('content')
    </div>

</div>

</body>
</html>
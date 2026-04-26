<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.Admin Panel') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-72 fixed top-0 left-0 h-screen bg-slate-950 text-white p-6 flex flex-col justify-between shadow-2xl">

        <!-- Top Section -->
        <div>

            <!-- Logo / Brand -->
            <div class="mb-10">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-2xl shadow-lg">
                        🛍️
                    </div>

                    <div>
                        <h2 class="text-xl font-extrabold tracking-wide">
                            {{ __('messages.Clothify Admin') }}
                        </h2>
                        <p class="text-xs text-slate-400 mt-1">
                            Management Panel
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">

                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/dashboard*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/dashboard*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        📊
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.dashboard') }}
                    </span>
                </a>


                <a href="{{ route('admin.orders.filter') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/orders*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/orders*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        📦
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.orders') }}
                    </span>
                </a>


                <a href="{{ route('admin.products.index') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/products*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/products*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        👕
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.products') }}
                    </span>
                </a>


                <a href="{{ route('admin.users.index') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/users*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/users*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        👥
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.users') }}
                    </span>
                </a>


                <a href="{{ route('admin.categories.index') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/categories*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/categories*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        🗂️
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.categories') }}
                    </span>
                </a>


                <a href="{{ route('admin.profile') }}"
                   class="group flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-300
                   {{ request()->is('admin/profile*')
                      ? 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-lg'
                      : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">

                    <span class="w-9 h-9 rounded-xl flex items-center justify-center
                    {{ request()->is('admin/profile*') ? 'bg-white/20' : 'bg-white/5 group-hover:bg-white/10' }}">
                        👤
                    </span>

                    <span class="font-semibold">
                        {{ __('messages.admin_profile') }}
                    </span>
                </a>

            </nav>
        </div>


        <!-- Bottom Section -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-4">
            <p class="text-xs text-slate-400 mb-1">
                Logged in as
            </p>

            <p class="text-sm font-bold text-white truncate">
                {{ auth()->user()->name ?? 'Admin' }}
            </p>

            <p class="text-xs text-slate-500 truncate">
                {{ auth()->user()->email ?? '' }}
            </p>
        </div>

    </aside>


    <!-- Main Content -->
    <main class="flex-1 ml-72 min-h-screen bg-gradient-to-br from-slate-100 via-slate-50 to-indigo-50 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>
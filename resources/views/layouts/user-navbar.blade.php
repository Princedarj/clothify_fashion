@php
    $cart = session()->get('cart', []);
    $cartCount = array_sum(array_column($cart, 'quantity'));
@endphp

<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" 
                class="text-3xl font-extrabold tracking-wide"
                style="font-family: 'Poppins', sans-serif;">

                    <span class="text-blue-900">
                        Clothify
                    </span>

                    <span class="text-gray-800 italic">
                        Fashions
                    </span>

            </a>

            <!-- Center Menu -->
                <div class="hidden md:flex space-x-10 text-gray-700 font-medium items-center">

                    <!-- Home -->
                    <a href="{{ route('dashboard') }}" 
                    class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('dashboard') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                        Home
                    </a>

                    <!-- Shop -->
                    <a href="{{ route('products.index') }}" 
                    class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('products.index') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                        Shop
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" 
                    class="relative px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('cart.*') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                        Cart
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-black text-white text-xs px-2 py-0.5 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- My Orders -->
                    <a href="{{ route('orders.my') }}" 
                    class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('orders.my') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                        My Orders
                    </a>

            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-6">

                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">

                        <button class="flex items-center space-x-2 text-gray-700 hover:text-black">
                            <span class="font-medium">
                                {{ auth()->user()->name }}
                            </span>
                            <svg class="w-4 h-4 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" 
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div class="absolute right-0 mt-3 w-40 bg-white border rounded-lg shadow-lg 
                                    opacity-0 invisible group-hover:opacity-100 
                                    group-hover:visible transition duration-200">

                            <a href="{{ route('profile.edit') }}" 
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>

                @else
                    <a href="{{ route('login') }}" 
                       class="bg-black text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                        Login
                    </a>
                @endauth

            </div>

        </div>
    </div>
</nav>
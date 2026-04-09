@php
    $cart = session()->get('cart', []);
    $cartCount = array_sum(array_column($cart, 'quantity'));
@endphp

<nav class="bg-white shadow-sm border-b relative fixed top-0 left-0 w-full z-10">
    <div class="max-w-7xl mx-auto px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" 
                class="text-3xl font-extrabold tracking-wide"
                style="font-family: 'Poppins', sans-serif;">

                <span class="text-blue-900">
                    {{ __('messages.Brand Name') }}
                </span>

                <span class="text-gray-800 italic">
                    {{ __('messages.Fashions') }}
                </span>

            </a>

            <!-- Center Menu -->
            <div class="hidden md:flex space-x-10 text-gray-700 font-medium items-center">

                <!-- Home -->
                <a href="{{ route('dashboard') }}" 
                class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('dashboard') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                    {{ __('messages.Home') }}
                </a>

                <!-- Shop -->
                <a href="{{ route('products.index') }}" 
                class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('products.index') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                    {{ __('messages.Shop') }}
                </a>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" 
                class="relative px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('cart.*') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                    {{ __('messages.Cart') }}
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-black text-white text-xs px-2 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- My Orders (only for logged in users) -->
                @auth
                <a href="{{ route('orders.my') }}" 
                class="px-3 py-2 rounded-md hover:text-black hover:bg-gray-100 transition duration-200 {{ request()->routeIs('orders.my') ? 'font-bold text-indigo-600 bg-gray-100' : '' }}">
                    {{ __('messages.My Orders') }}
                </a>
                @endauth

            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-6">

                <!-- 👤 Logged In -->
                @auth
                    <div x-data="{ open: false }" class="relative">

                        <!-- Button -->
                        <button @click="open = !open"
                            class="flex items-center space-x-2 text-gray-700 hover:text-black">
                            
                            <span class="font-medium">
                                {{ auth()->user()->name }}
                            </span>

                            <svg class="w-4 h-4 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" 
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open"
                            x-transition
                            @click.outside="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-[999]">

                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}" 
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('messages.Profile') }}
                            </a>

                            <!-- Language -->
                            <div class="border-t my-1"></div>

                            <p class="px-4 py-2 text-xs text-gray-500">
                                {{ __('messages.Language') }}
                            </p>

                            <a href="{{ route('lang.switch', 'en') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">
                                🇺🇸 English
                            </a>

                            <a href="{{ route('lang.switch', 'hi') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">
                                🇮🇳 Hindi
                            </a>

                            <a href="{{ route('lang.switch', 'gu') }}"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">
                                🇮🇳 Gujarati
                            </a>

                            <!-- Logout -->
                            <div class="border-t my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    {{ __('messages.Logout') }}
                                </button>
                            </form>

                        </div>
                    </div>
                @endauth

                <!-- 👤 Guest -->
                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-semibold text-gray-700 hover:text-black">
                        {{ __('messages.Login') }}
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 text-sm font-semibold bg-black text-white rounded hover:bg-gray-800">
                        {{ __('messages.Register') }}
                    </a>
                @endguest

            </div>

        </div>
    </div>
</nav>
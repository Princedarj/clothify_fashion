@php
    $cart = session()->get('cart', []);
    $cartCount = array_sum(array_column($cart, 'quantity'));
@endphp

<nav class="fixed top-0 left-0 w-full z-50 bg-white/95 dark:bg-gray-950/95 backdrop-blur-md border-b border-gray-200 dark:border-gray-800 shadow-sm transition-colors mb-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-full bg-gradient-to-br from-gray-900 to-gray-700 dark:from-indigo-700 dark:to-gray-900 flex items-center justify-center shadow-md">
                    <span class="text-white text-xl">👔</span>
                </div>

                <div class="leading-tight">
                    <h1 class="text-2xl font-extrabold tracking-wide text-gray-900 dark:text-white">
                        {{ __('messages.Brand Name') }}
                        <span class="text-indigo-600 dark:text-indigo-400">{{ __('messages.Fashions') }}</span>
                    </h1>
                    <p class="text-xs tracking-[0.25em] uppercase text-gray-500 dark:text-gray-400">
                        {{ __('messages.premium_mens_fashion') }}
                    </p>
                </div>
            </a>

            {{-- Center Menu --}}
            <div class="hidden md:flex items-center gap-3 bg-gray-100 dark:bg-gray-900 px-3 py-2 rounded-full border border-transparent dark:border-gray-800">

                <a href="{{ route('dashboard') }}"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition
                   {{ request()->routeIs('dashboard') 
                        ? 'bg-gray-900 dark:bg-indigo-600 text-white shadow' 
                        : 'text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                    🏠 {{ __('messages.Home') }}
                </a>

                <a href="{{ route('products.index') }}"
                   class="px-5 py-2 rounded-full text-sm font-semibold transition
                   {{ request()->routeIs('products.index') 
                        ? 'bg-gray-900 dark:bg-indigo-600 text-white shadow' 
                        : 'text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                    🛍️ {{ __('messages.Shop') }}
                </a>

                <a href="{{ route('cart.index') }}"
                   class="relative px-5 py-2 rounded-full text-sm font-semibold transition
                   {{ request()->routeIs('cart.*') 
                        ? 'bg-gray-900 dark:bg-indigo-600 text-white shadow' 
                        : 'text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                    🛒 {{ __('messages.Cart') }}

                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full shadow">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                @auth
                    <a href="{{ route('orders.my') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold transition
                       {{ request()->routeIs('orders.my') 
                            ? 'bg-gray-900 dark:bg-indigo-600 text-white shadow' 
                            : 'text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }}">
                        📦 {{ __('messages.My Orders') }}
                    </a>
                @endauth

            </div>

            {{-- Right Side --}}
            <div class="flex items-center gap-4">

                {{-- Theme Button --}}
                <button type="button" onclick="toggleTheme()"
                    class="w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white flex items-center justify-center hover:scale-110 transition border border-gray-200 dark:border-gray-700">
                    <span id="themeIcon">🌙</span>
                </button>

                @auth
                    <div x-data="{ open: false }" class="relative">

                        <button @click="open = !open"
                            class="flex items-center gap-3 bg-gray-100 dark:bg-gray-900 hover:bg-gray-200 dark:hover:bg-gray-800 px-4 py-2 rounded-full transition border border-transparent dark:border-gray-800">

                            <div class="w-9 h-9 rounded-full bg-gray-900 dark:bg-indigo-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <span class="hidden sm:block text-sm font-semibold text-gray-800 dark:text-gray-200">
                                {{ auth()->user()->name }}
                            </span>

                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             x-transition
                             @click.outside="open = false"
                             class="absolute right-0 mt-3 w-56 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-xl overflow-hidden z-[999]">

                            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800">
                                <p class="text-sm font-bold text-gray-800 dark:text-white">
                                    👋 {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ __('messages.premium_mens_fashion') }}
                                </p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                👤 {{ __('messages.Profile') }}
                            </a>

                            <div class="border-t border-gray-200 dark:border-gray-800"></div>

                            <p class="px-4 pt-3 pb-1 text-xs uppercase tracking-wide text-gray-400">
                                {{ __('messages.Language') }}
                            </p>

                            <a href="{{ route('lang.switch', 'en') }}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                🇺🇸 English
                            </a>

                            <a href="{{ route('lang.switch', 'hi') }}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                🇮🇳 Hindi
                            </a>

                            <a href="{{ route('lang.switch', 'gu') }}"
                               class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">
                                🇮🇳 Gujarati
                            </a>

                            <div class="border-t border-gray-200 dark:border-gray-800 mt-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/40">
                                    🚪 {{ __('messages.Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        {{ __('messages.Login') }}
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-5 py-2 rounded-full text-sm font-semibold bg-gray-900 dark:bg-indigo-600 text-white hover:bg-indigo-600 dark:hover:bg-indigo-700 shadow transition">
                        {{ __('messages.Register') }}
                    </a>
                @endguest

            </div>

        </div>
    </div>
</nav>
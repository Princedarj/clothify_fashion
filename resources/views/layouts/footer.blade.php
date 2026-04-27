<!-- FOOTER -->
<footer class="bg-[#070707] text-white pt-20 pb-8 border-t border-gray-800 overflow-x-hidden">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Top Footer -->
        <div class="grid md:grid-cols-4 gap-12">

            <!-- Brand -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 rounded-full bg-white text-black flex items-center justify-center text-2xl shadow-lg">
                        👔
                    </div>

                    <div>
                        <h3 class="text-2xl font-extrabold tracking-wide">
                            {{ __('messages.Brand Name') }}
                        </h3>
                        <p class="text-xs tracking-[0.25em] uppercase text-gray-400">
                            Men’s Wear
                        </p>
                    </div>
                </div>

                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ __('messages.Footer Description') }}
                </p>

                <!-- Social Icons -->
                <div class="flex gap-3 mt-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center hover:bg-white hover:text-black transition">
                        f
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center hover:bg-white hover:text-black transition">
                        𝕏
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-900 flex items-center justify-center hover:bg-white hover:text-black transition">
                        ◎
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
                    🧭 {{ __('messages.Quick Links') }}
                </h4>

                <ul class="space-y-3 text-gray-400 text-sm">
                    <li>
                        <a href="{{ route('dashboard') }}" class="hover:text-white transition">
                            → {{ __('messages.Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-white transition">
                            → {{ __('messages.Shop') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cart.index') }}" class="hover:text-white transition">
                            → {{ __('messages.Cart') }}
                        </a>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('orders.my') }}" class="hover:text-white transition">
                                → {{ __('messages.My Orders') }}
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
                    🛡️ {{ __('messages.Support') }}
                </h4>

                <ul class="space-y-3 text-gray-400 text-sm">
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">→ {{ __('messages.Contact Us') }}</a></li>
                    <li><a href="{{ route('faqs') }}" class="hover:text-white transition">→ {{ __('messages.FAQs') }}</a></li>
                    <li><a href="{{ route('shipping.policy') }}" class="hover:text-white transition">→ {{ __('messages.Shipping Policy') }}</a></li>
                    <li><a href="{{ route('return.policy') }}" class="hover:text-white transition">→ {{ __('messages.Return Policy') }}</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 class="font-bold mb-5 text-lg flex items-center gap-2">
                    ✉️ {{ __('messages.Subscribe') }}
                </h4>

                <p class="text-gray-400 text-sm mb-5 leading-relaxed">
                    {{ __('messages.Subscribe Description') }}
                </p>

                <form class="bg-white/10 border border-gray-800 rounded-3xl p-2 flex flex-col sm:flex-row gap-2 overflow-hidden">
    
                    <input type="email"
                        placeholder="{{ __('messages.Enter Email') }}"
                        class="w-full bg-transparent px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none">

                    <button type="submit"
                        class="bg-white text-black px-5 py-3 rounded-full text-sm font-bold hover:bg-indigo-500 hover:text-white transition">
                        {{ __('messages.Join') }}
                    </button>

                </form>

                <div class="mt-6 bg-gray-900/70 border border-gray-800 rounded-2xl p-4">
                    <p class="text-sm font-semibold text-white">
                        🔥 Premium Men’s Collection
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        Shirts • T-Shirts • Jeans • Jackets
                    </p>
                </div>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 mt-14 pt-6 flex flex-col md:flex-row justify-between items-center gap-4 text-gray-500 text-sm">

            <p>
                © {{ date('Y') }} {{ __('messages.Brand Name') }}.
                {{ __('messages.All Rights Reserved') }}
            </p>

            <p class="text-gray-500">
                Crafted for modern gentlemen 👞
            </p>

        </div>

    </div>
</footer>
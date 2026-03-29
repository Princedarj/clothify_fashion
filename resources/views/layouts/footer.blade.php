<!-- FOOTER -->
<footer class="bg-black text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-4 gap-10">

        <!-- Brand -->
        <div>
            <h3 class="text-3xl font-bold mb-4 tracking-wide">
                {{ __('messages.Brand Name') }}
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                {{ __('messages.Footer Description') }}
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">
                {{ __('messages.Quick Links') }}
            </h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('dashboard') }}" class="hover:text-white">{{ __('messages.Home') }}</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-white">{{ __('messages.Shop') }}</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-white">{{ __('messages.Cart') }}</a></li>
                <li><a href="{{ route('orders.my') }}" class="hover:text-white">{{ __('messages.My Orders') }}</a></li>
            </ul>
        </div>

        <!-- Support -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">
                {{ __('messages.Support') }}
            </h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">{{ __('messages.Contact Us') }}</a></li>
                <li><a href="#" class="hover:text-white">{{ __('messages.FAQs') }}</a></li>
                <li><a href="#" class="hover:text-white">{{ __('messages.Shipping Policy') }}</a></li>
                <li><a href="#" class="hover:text-white">{{ __('messages.Return Policy') }}</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">
                {{ __('messages.Subscribe') }}
            </h4>
            <p class="text-gray-400 text-sm mb-4">
                {{ __('messages.Subscribe Description') }}
            </p>
            <form class="flex">
                <input type="email"
                    placeholder="{{ __('messages.Enter Email') }}"
                    class="w-full px-3 py-2 rounded-l-md text-black focus:outline-none">
                <button type="submit"
                    class="bg-white text-black px-4 rounded-r-md hover:bg-gray-200">
                    {{ __('messages.Join') }}
                </button>
            </form>
        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800 mt-12 pt-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} {{ __('messages.Brand Name') }}. {{ __('messages.All Rights Reserved') }}
    </div>
</footer>
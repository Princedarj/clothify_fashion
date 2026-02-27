@extends('layouts.user')

@section('content')

@if(session('success'))
    <div id="successToast"
         class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('successToast');
            if (toast) {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>
@endif

<div class="-mx-4 sm:-mx-6 lg:-mx-8">
<!-- HERO SECTION -->
<section class="relative min-h-[90vh] pt-16  bg-cover bg-center flex items-center justify-center"
    style="background-image: url('{{ asset('uploads/Image/Background.jpg') }}');">

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 text-center text-white px-6 max-w-4xl">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
            Elevate Your Everyday Style
        </h1>

        <p class="text-lg md:text-xl opacity-90 mb-8">
            Discover curated fashion collections designed for confidence,
            comfort and timeless elegance.
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-block px-8 py-3 bg-white text-black font-semibold rounded-full shadow-lg hover:scale-105 transition duration-300">
            Explore Collection
        </a>
    </div>
</section>


<!-- FEATURE SECTION -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-16 text-center">

        <div class="space-y-4">
            <div class="text-5xl">🚚</div>
            <h3 class="text-xl font-semibold">Free Shipping</h3>
            <p class="text-gray-500 text-sm">
                Enjoy fast and free delivery on all premium orders.
            </p>
        </div>

        <div class="space-y-4">
            <div class="text-5xl">💎</div>
            <h3 class="text-xl font-semibold">Premium Quality</h3>
            <p class="text-gray-500 text-sm">
                Crafted with precision using high-quality materials.
            </p>
        </div>

        <div class="space-y-4">
            <div class="text-5xl">🔒</div>
            <h3 class="text-xl font-semibold">Secure Payment</h3>
            <p class="text-gray-500 text-sm">
                100% secure transactions with trusted payment systems.
            </p>
        </div>

    </div>
</section>


<!-- PRODUCT PREVIEW SECTION -->
<section class="bg-gray-50 py-24">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-16">
            Latest Arrivals
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($products->take(3) as $product)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-500 overflow-hidden group">

                <div class="h-80 bg-gray-100 flex items-center justify-center overflow-hidden relative">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        onerror="this.src='https://via.placeholder.com/400x400';"
                        class="max-w-full max-h-full rounded-2xl object-cover transition duration-500 group-hover:scale-125">
                </div>

                <div class="p-6 space-y-3">
                    <h3 class="font-semibold text-lg">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-500 text-sm line-clamp-2">
                        {{ $product->description }}
                    </p>

                    <div class="flex justify-between items-center pt-3">
                        <span class="text-xl font-bold text-black">
                            ₹ {{ $product->price }}
                        </span>

                        <a href="{{ route('products.index') }}"
                           class="text-sm font-semibold text-black border-b border-black hover:opacity-70 transition">
                            View
                        </a>
                    </div>
                </div>

            </div>
            @endforeach

        </div>

    </div>
</section>


<!-- FOOTER -->
<footer class="bg-black text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-4 gap-10">

        <!-- Brand -->
        <div>
            <h3 class="text-3xl font-bold mb-4 tracking-wide">Clothify</h3>
            <p class="text-gray-400 text-sm leading-relaxed">
                Elevate your everyday style with curated collections designed 
                for confidence and comfort.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">Quick Links</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('dashboard') }}" class="hover:text-white">Home</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-white">Shop</a></li>
                <li><a href="{{ route('cart.index') }}" class="hover:text-white">Cart</a></li>
                <li><a href="{{ route('orders.my') }}" class="hover:text-white">My Orders</a></li>
            </ul>
        </div>

        <!-- Support -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">Support</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#" class="hover:text-white">Contact Us</a></li>
                <li><a href="#" class="hover:text-white">FAQs</a></li>
                <li><a href="#" class="hover:text-white">Shipping Policy</a></li>
                <li><a href="#" class="hover:text-white">Return Policy</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">Subscribe</h4>
            <p class="text-gray-400 text-sm mb-4">
                Get updates about new arrivals & exclusive offers.
            </p>
            <form class="flex">
                <input type="email" placeholder="Enter your email"
                    class="w-full px-3 py-2 rounded-l-md text-black focus:outline-none">
                <button type="submit"
                    class="bg-white text-black px-4 rounded-r-md hover:bg-gray-200">
                    Join
                </button>
            </form>
        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800 mt-12 pt-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} Clothify. All rights reserved.
    </div>
</footer>
</div>
@endsection
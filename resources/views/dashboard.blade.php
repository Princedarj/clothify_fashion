@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="relative h-screen bg-cover bg-center"
    style="background-image: url('{{ asset('uploads/Image/Background.jpg') }}');">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative z-10 flex flex-col justify-center items-center h-full text-center text-white px-6">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 tracking-wide">
            Elevate Your Everyday Style
        </h1>

        <p class="max-w-2xl text-lg md:text-xl opacity-90 mb-8">
            Discover curated fashion collections designed for confidence,
            comfort and timeless elegance.
        </p>

        <a href="{{ route('products.index') }}"
            class="px-8 py-3 bg-white text-black font-semibold tracking-wide hover:bg-gray-200 transition duration-300">
            Explore Collection
        </a>
    </div>
</section>


<!-- FEATURE SECTION -->
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-12 text-center">

        <div>
            <div class="text-4xl mb-4">🚚</div>
            <h3 class="text-xl font-semibold mb-2">Free Shipping</h3>
            <p class="text-gray-600 text-sm">
                Enjoy fast and free delivery on all premium orders.
            </p>
        </div>

        <div>
            <div class="text-4xl mb-4">💎</div>
            <h3 class="text-xl font-semibold mb-2">Premium Quality</h3>
            <p class="text-gray-600 text-sm">
                Crafted with precision using high-quality materials.
            </p>
        </div>

        <div>
            <div class="text-4xl mb-4">🔒</div>
            <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
            <p class="text-gray-600 text-sm">
                100% secure transactions with trusted payment systems.
            </p>
        </div>

    </div>
</section>


<!-- PRODUCT PREVIEW SECTION -->
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-3xl font-semibold text-center mb-12">
            Featured Collection / Latest Arrivals
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-20 ">

            @foreach($products->take(3) as $product)
            <div class="bg-gray-100 rounded-lg shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden group">

                <div class="h-80 flex items-center justify-center bg-gray-350 overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        onerror="this.src='https://via.placeholder.com/400x400';"
                        class="max-h-full max-w-full rounded-lg object-contain transition duration-500 hover:scale-105">
                </div>

                <div class="p-6">
                    <h3 class="font-semibold text-lg mb-2">
                        {{ $product->name }}
                    </h3>

                    <p class="text-gray-500 text-sm mb-4 line-clamp-2">
                        {{ $product->description }}
                    </p>

                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold">
                            ₹ {{ $product->price }}
                        </span>

                        <a href="{{ route('products.index') }}"
                           class="text-sm font-medium underline hover:text-gray-600">
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
<footer class="bg-black text-white py-12 text-center">
    <h3 class="text-2xl font-semibold mb-4">Clothify</h3>
    <p class="text-gray-400 text-sm">
        © {{ date('Y') }} Clothify. All rights reserved.
    </p>
</footer>

@endsection
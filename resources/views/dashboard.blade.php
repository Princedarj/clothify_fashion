@extends('layouts.user')

@section('content')

@if(session('success'))
    <div id="successToast"
         class="fixed top-6 right-6 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ __(session('success')) }}
    </div>
@endif

<div class="-mx-4 sm:-mx-6 lg:-mx-8">

<!-- HERO SECTION -->
<section class="relative min-h-[90vh] pt-16 bg-cover bg-center flex items-center justify-center"
    style="background-image: url('{{ asset('uploads/Image/Background.jpg') }}');">

    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative z-10 text-center text-white px-6 max-w-4xl">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
            {{ __('messages.Hero Title') }}
        </h1>

        <p class="text-lg md:text-xl opacity-90 mb-8">
            {{ __('messages.Hero Description') }}
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-block px-8 py-3 bg-white text-black font-semibold rounded-full shadow-lg hover:scale-105 transition duration-300">
            {{ __('messages.Explore Collection') }}
        </a>
    </div>
</section>

<!-- FEATURE SECTION -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-16 text-center">

        <div class="space-y-4">
            <div class="text-5xl">🚚</div>
            <h3 class="text-xl font-semibold">{{ __('messages.Free Shipping') }}</h3>
            <p class="text-gray-500 text-sm">{{ __('messages.Free Shipping Desc') }}</p>
        </div>

        <div class="space-y-4">
            <div class="text-5xl">💎</div>
            <h3 class="text-xl font-semibold">{{ __('messages.Premium Quality') }}</h3>
            <p class="text-gray-500 text-sm">{{ __('messages.Premium Quality Desc') }}</p>
        </div>

        <div class="space-y-4">
            <div class="text-5xl">🔒</div>
            <h3 class="text-xl font-semibold">{{ __('messages.Secure Payment') }}</h3>
            <p class="text-gray-500 text-sm">{{ __('messages.Secure Payment Desc') }}</p>
        </div>

    </div>
</section>

<!-- PRODUCT SECTION -->
<section class="bg-gray-50 py-24">
    <div class="max-w-7xl mx-auto px-6">

        <h2 class="text-4xl font-bold text-center mb-16">
            {{ __('messages.Latest Arrivals') }}
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @foreach($products->take(3) as $product)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-500 overflow-hidden group">

                <div class="h-80 bg-gray-100 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        onerror="this.src='https://via.placeholder.com/400x400';"
                        class="max-w-full max-h-full object-cover">
                </div>

                <div class="p-6 space-y-3">
                    <h3 class="font-semibold text-lg">{{ $product->name }}</h3>

                    <p class="text-gray-500 text-sm">
                        {{ $product->description }}
                    </p>

                    <div class="flex justify-between items-center pt-3">
                        <span class="text-xl font-bold text-black">
                            ₹ {{ $product->price }}
                        </span>

                        <a href="{{ route('products.index') }}"
                           class="text-sm font-semibold text-black border-b border-black">
                            {{ __('messages.View') }}
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
            <p class="text-gray-400 text-sm">
                {{ __('messages.Footer Description') }}
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">{{ __('messages.Quick Links') }}</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="{{ route('dashboard') }}">{{ __('messages.Home') }}</a></li>
                <li><a href="{{ route('products.index') }}">{{ __('messages.Shop') }}</a></li>
                <li><a href="{{ route('cart.index') }}">{{ __('messages.Cart') }}</a></li>
                <li><a href="{{ route('orders.my') }}">{{ __('messages.My Orders') }}</a></li>
            </ul>
        </div>

        <!-- Support -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">{{ __('messages.Support') }}</h4>
            <ul class="space-y-2 text-gray-400 text-sm">
                <li><a href="#">{{ __('messages.Contact Us') }}</a></li>
                <li><a href="#">{{ __('messages.FAQs') }}</a></li>
                <li><a href="#">{{ __('messages.Shipping Policy') }}</a></li>
                <li><a href="#">{{ __('messages.Return Policy') }}</a></li>
            </ul>
        </div>

        <!-- Newsletter -->
        <div>
            <h4 class="font-semibold mb-4 text-lg">{{ __('messages.Subscribe') }}</h4>
            <p class="text-gray-400 text-sm mb-4">
                {{ __('messages.Subscribe Desc') }}
            </p>
            <form class="flex">
                <input type="email" placeholder="{{ __('messages.Enter Email') }}"
                    class="w-full px-3 py-2 text-black">
                <button type="submit" class="bg-white text-black px-4">
                    {{ __('messages.Join') }}
                </button>
            </form>
        </div>

    </div>

    <div class="border-t border-gray-800 mt-12 pt-6 text-center text-gray-500 text-sm">
        © {{ date('Y') }} Clothify. {{ __('messages.All rights reserved') }}
    </div>
</footer>

</div>
@endsection
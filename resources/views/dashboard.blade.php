@extends('layouts.user')

@section('content')

<style>
    @keyframes heroZoom {
        0% { transform: scale(1.08); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .hero-bg {
        animation: heroZoom 1.4s ease-out forwards;
    }

    .fade-up {
        animation: fadeUp 0.9s ease-out forwards;
    }

    .delay-1 { animation-delay: .2s; opacity: 0; }
    .delay-2 { animation-delay: .4s; opacity: 0; }
    .delay-3 { animation-delay: .6s; opacity: 0; }
</style>

<div class="w-full overflow-x-hidden pt-10 bg-white dark:bg-gray-950 transition-colors duration-300">
    <!-- HERO SECTION -->
    <section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden bg-black">

        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center hero-bg"
             style="background-image: url('{{ asset('uploads/Image/Background.jpg') }}');">
        </div>

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/75 to-black/40"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,rgba(0,0,0,0.7)_75%)]"></div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-3xl text-white">

                <p class="fade-up delay-1 inline-block mb-5 px-5 py-2 rounded-full bg-white/10 border border-white/20 text-sm tracking-[0.25em] uppercase">
                    {{ __('messages.premium_mens_fashion') }}
                </p>

                <h1 class="fade-up delay-2 text-5xl md:text-7xl font-extrabold leading-tight mb-6">
                    {{ __('messages.Hero Title') }}
                </h1>

                <p class="fade-up delay-3 text-lg md:text-xl text-gray-200 leading-relaxed mb-9 max-w-2xl">
                    {{ __('messages.Hero Description') }}
                </p>

                <div class="fade-up delay-3 flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}"
                       class="px-8 py-4 bg-white text-black font-bold rounded-full shadow-xl hover:bg-indigo-600 hover:text-white hover:scale-105 transition duration-300">
                        {{ __('messages.Explore Collection') }} →
                    </a>

                    <a href="#latest"
                       class="px-8 py-4 border border-white/40 text-white font-semibold rounded-full hover:bg-white hover:text-black transition duration-300">
                       {{ __('messages.Latest Arrivals') }}
                    </a>
                </div>

            </div>
        </div>

        <!-- Bottom Stats -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 hidden md:flex bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl overflow-hidden text-white">
            <div class="px-8 py-4 border-r border-white/20">
                <p class="text-2xl font-bold">100%</p>
                <p class="text-xs text-gray-300">{{ __('messages.premium_fabric') }}</p>
            </div>
            <div class="px-8 py-4 border-r border-white/20">
                <p class="text-2xl font-bold">{{ __('messages.fast') }}</p>
                <p class="text-xs text-gray-300">{{ __('messages.delivery') }}</p>
            </div>
            <div class="px-8 py-4">
                <p class="text-2xl font-bold">{{ __('messages.secure') }}</p>
                <p class="text-xs text-gray-300">{{ __('messages.payment') }}</p>
            </div>
        </div>

    </section>

    <!-- FEATURE SECTION -->
    <section class="py-24 bg-white dark:bg-gray-950">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">

<div class="group p-8 rounded-3xl text-black bg-gray-50 hover:bg-gray-200 dark:bg-gray-900 border border-gray-100 dark:text-white dark:border-gray-800 dark:hover:text-amber-400 transition duration-300">                <div class="text-5xl mb-5">🚚</div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.Free Shipping') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 dark:group-hover:text-amber-400 text-sm">
                    {{ __('messages.Free Shipping Desc') }}
                </p>
            </div>

<div class="group p-8 rounded-3xl text-black bg-gray-50 hover:bg-gray-200 dark:bg-gray-900 border border-gray-100 dark:text-white dark:border-gray-800 dark:hover:text-amber-400 transition duration-300">                <div class="text-5xl mb-5">💎</div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.Premium Quality') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 dark:group-hover:text-amber-400 text-sm">
                    {{ __('messages.Premium Quality Desc') }}
                </p>
            </div>

<div class="group p-8 rounded-3xl text-black bg-gray-50 hover:bg-gray-200 dark:bg-gray-900 border border-gray-100 dark:text-white dark:border-gray-800 dark:hover:text-amber-400 transition duration-300">                <div class="text-5xl mb-5">🔒</div>
                <h3 class="text-xl font-bold mb-3">{{ __('messages.Secure Payment') }}</h3>
                <p class="text-gray-500 dark:text-gray-400 dark:group-hover:text-amber-400 text-sm">
                    {{ __('messages.Secure Payment Desc') }}
                </p>
            </div>

        </div>
    </section>

    <!-- PRODUCT SECTION -->
    <section id="latest" class="bg-[#f6f6f6] dark:bg-gray-950 py-24">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">
                <p class="text-sm uppercase tracking-[0.3em] text-gray-500 dark:text-gray-400 mb-3">
                    {{ __('messages.new_collection') }}
                </p>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">
                    {{ __('messages.Latest Arrivals') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

                @foreach($products->take(3) as $product)
                    <div class="group bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm hover:shadow-2xl transition duration-500 overflow-hidden border border-gray-100 dark:border-gray-800">

                       <div class="relative h-80 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 loading="lazy"
                                 onerror="this.src='https://via.placeholder.com/400x400';"
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                            <div class="absolute top-4 left-4 bg-black text-white text-xs px-4 py-2 rounded-full">
                                {{ __('messages.new') }}
                            </div>
                        </div>

                        <div class="p-7">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-2">
                                {{ $product->getName() ?? $product->name }}
                            </h3>

                           <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-2 mb-5">
                                {{ $product->{'description_' . app()->getLocale()} ?? $product->description }}
                            </p>

                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-extrabold text-gray-900 dark:text-white">
                                    ₹ {{ number_format($product->price) }}
                                </span>

                               <a href="{{ route('products.index') }}"
                                    class="px-5 py-2 rounded-full bg-gray-900 dark:bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                                    {{ __('messages.View') }}
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

            <div class="text-center mt-14">
                <a href="{{ route('products.index') }}"
                    class="inline-block px-9 py-4 rounded-full bg-black dark:bg-indigo-600 text-white font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                    {{ __('messages.view_all_products') }} →
                </a>
            </div>

        </div>
    </section>

</div>

@endsection
@extends('layouts.user')

@section('content')

@php
    $locale = app()->getLocale();

    $name = $product->{'name_' . $locale} ?? $product->name_en;
    $description = $product->{'description_' . $locale} ?? $product->description_en ?? '';
@endphp

<div class="min-h-screen bg-gray-50 dark:bg-gray-950 py-12 px-4">

    <div class="max-w-7xl mx-auto">

        {{-- Breadcrumb --}}
        <div class="mb-6 text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ url('/') }}" class="hover:text-yellow-500">
                {{ __('messages.home') }}
            </a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 dark:text-white">
                {{ $name }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 p-10 mb-10 mt-20 bg-white dark:bg-gray-900 rounded-[2rem] shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-800">
            {{-- Product Image --}}
            <div class="relative overflow-hidden rounded-[2rem] bg-gray-100 dark:bg-gray-800 self-start">
                @if($product->created_at && $product->created_at->gt(now()->subDays(10)))
                    <span class="absolute top-4 left-4 z-30 bg-black text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg dark:text-black dark:bg-white">
                        {{ __('messages.new') }}
                    </span>
                @endif

                <img src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $name }}"
                    class="w-full h-[700px] object-cover rounded-[2rem]">
            </div>

            {{-- Product Details --}}
            <div class="p-8 lg:p-12 flex flex-col justify-center">
                <p class="text-yellow-500 font-bold uppercase tracking-widest mb-3 dark:text-white">
                    {{ $product->category->getName() ?? __('messages.product') }}
                </p>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-950 dark:text-white mb-5">
                    {{ $name }}
                </h1>

                <p class="text-gray-600 dark:text-gray-300 text-lg leading-8 mb-8">
                    {{ $description }}
                </p>

                <div class="mb-8">
                    <span class="text-4xl font-black text-gray-950 dark:text-white">
                        ₹{{ number_format($product->price) }}
                    </span>
                </div>

                {{-- Features --}}
                <div class="grid grid-cols-2 gap-4 mb-8">

                    <div class="p-4 rounded-2xl bg-gray-100 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.quality') }}
                        </p>
                        <p class="font-bold text-gray-900 dark:text-white">
                            {{ __('messages.premium') }}
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-gray-100 dark:bg-gray-800">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ __('messages.delivery') }}
                        </p>
                        <p class="font-bold text-gray-900 dark:text-white">
                            {{ __('messages.fast_delivery') }}
                        </p>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <button type="submit"
                            class="w-full px-8 py-4 rounded-full bg-black text-white font-bold text-lg hover:bg-gray-800 transition dark:bg-white dark:text-black">
                            🛒 {{ __('messages.add_to_cart') }}
                        </button>
                    </form>

                    <form action="{{ route('buy.now', $product->id) }}" method="POST" class="w-full">
                        @csrf

                        <button type="submit"
                            class="w-full text-center px-8 py-4 rounded-full bg-yellow-400 text-black font-bold text-lg hover:bg-yellow-300 transition">
                            ⚡ {{ __('messages.buy_now') }}
                        </button>
                    </form>

                </div>

                {{-- Trust --}}
                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-gray-600 dark:text-gray-300">

                    <div>✅ {{ __('messages.secure_payment') }}</div>
                    <div>🚚 {{ __('messages.free_shipping') }}</div>
                    <div>↩️ {{ __('messages.easy_return') }}</div>

                </div>

            </div>    
        </div>

        {{-- Related Products --}}
        <div class="mt-16 px-4 sm:px-6 lg:px-8">

            <div class="max-w-7xl mx-auto">

                <div class="flex items-center justify-between mb-8">
                    <div>
                        <p class="text-yellow-500 font-bold uppercase tracking-widest dark:text-white">
                            {{ __('messages.more_products') }}
                        </p>
                        <h2 class="text-3xl font-black text-gray-950 dark:text-white">
                            {{ __('messages.from_our_website') }}
                        </h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 items-stretch">

                    @foreach($relatedProducts as $item)

                        @php
                            $itemName = $item->{'name_' . app()->getLocale()} ?? $item->name_en;
                            $itemDesc = $item->{'description_' . app()->getLocale()} ?? $item->description_en ?? '';
                            $isNew = $item->created_at && $item->created_at->gt(now()->subDays(10));
                        @endphp

                        <div class="h-full group bg-white dark:bg-gray-900 rounded-[2rem] shadow-xl overflow-hidden border border-gray-100 dark:border-gray-800 hover:-translate-y-2 transition duration-300 flex flex-col">

                            <div class="relative h-64 overflow-hidden bg-gray-100 dark:bg-gray-800">

                                @if($isNew)
                                    <span class="absolute top-4 left-4 z-30 bg-black text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                        {{ __('messages.new') }}
                                    </span>
                                @endif

                                <img src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $itemName }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="p-5 flex flex-col flex-1">

                                <h3 class="text-lg font-black text-gray-950 dark:text-white mb-2 line-clamp-1">
                                    {{ $itemName }}
                                </h3>

                                <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4 min-h-[44px]">
                                    {{ $itemDesc }}
                                </p>

                                <p class="text-2xl font-black text-gray-950 dark:text-white mb-4">
                                    ₹{{ number_format($item->price) }}
                                </p>

                                <a href="{{ route('products.show', $item->id) }}"
                                class="mt-auto w-full inline-flex justify-center items-center px-5 py-3 rounded-full bg-yellow-400 text-black font-bold hover:bg-black hover:text-white transition">
                                    👁 {{ __('messages.view_product') }}
                                </a>

                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
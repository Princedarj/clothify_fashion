@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-gray-950 transition-colors duration-300">

    {{-- HERO --}}
    <div class="relative bg-gradient-to-r from-black via-gray-900 to-indigo-900 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,0.35),transparent_35%)]"></div>

        <div class="relative max-w-7xl mx-auto px-6 pt-10">
            <p class="text-sm uppercase tracking-[0.3em] text-gray-300 mb-3">
                {{ __('messages.premium_mens_fashion') }}
            </p>

            <h1 class="text-4xl md:text-6xl font-extrabold mb-5 tracking-wide">
                {{ __('messages.Mens Collection') }}
            </h1>

            <p class="text-lg text-gray-300 max-w-2xl">
                {{ __('messages.Mens Collection Desc') }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- Sidebar --}}
        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-[2rem] shadow-lg border border-gray-100 dark:border-gray-800 h-fit sticky top-24 transition">

                <div class="mb-6">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                        🔎 {{ __('messages.Filter Products') }}
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ __('messages.find_your_style') }}
                    </p>
                </div>

                <form method="GET" action="{{ route('products.index') }}" class="space-y-5">

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">
                            {{ __('messages.Category') }}
                        </label>

                        <select name="category_id"
                            class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">{{ __('messages.All Categories') }}</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">
                            {{ __('messages.Min Price') }}
                        </label>

                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="₹"
                            class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 dark:text-gray-300">
                            {{ __('messages.Max Price') }}
                        </label>

                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="₹"
                            class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <button type="submit"
                        class="w-full bg-black dark:bg-indigo-600 text-white py-3 rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 hover:shadow-lg transition">
                        {{ __('messages.Apply Filter') }}
                    </button>

                    <a href="{{ route('products.index') }}"
                        class="block text-center w-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 py-3 rounded-full font-bold hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        {{ __('messages.clear_filter') }}
                    </a>

                </form>
            </div>
        </aside>

        {{-- Products --}}
        <main class="lg:col-span-3">

            {{-- Top Bar --}}
            <div class="bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800 p-5 mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4 transition">

                <p class="text-gray-600 dark:text-gray-300 text-sm">
                    {{ __('messages.Showing') }}
                    <span class="font-bold text-gray-900 dark:text-white">{{ $products->total() }}</span>
                    {{ __('messages.Products') }}
                </p>

                <form method="GET" class="flex items-center gap-3">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif

                    @if(request('min_price'))
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                    @endif

                    @if(request('max_price'))
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                    @endif

                    <label class="text-sm font-bold text-gray-700 dark:text-gray-300">
                        {{ __('messages.sort_by') }}
                    </label>

                    <select name="sort" onchange="this.form.submit()"
                        class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white rounded-2xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">

                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>
                            {{ __('messages.Sort Latest') }}
                        </option>

                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>
                            {{ __('messages.Price Low to High') }}
                        </option>

                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>
                            {{ __('messages.Price High to Low') }}
                        </option>
                    </select>
                </form>
            </div>

            {{-- Product Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($products as $product)
                    <div class="group bg-white dark:bg-gray-900 rounded-[2rem] shadow-sm hover:shadow-2xl transition duration-500 overflow-hidden border border-gray-100 dark:border-gray-800">

                        <div class="relative bg-gray-100 dark:bg-gray-800 aspect-[4/5] overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" loading="lazy"
                                onerror="this.src='https://via.placeholder.com/400x500';"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                            @if($product->created_at >= now()->subDays(10))
                                <div class="absolute top-4 left-4 bg-black dark:bg-indigo-600 text-white text-xs px-4 py-2 rounded-full">
                                    {{ __('messages.new') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-6">

                            <h3 class="text-xl font-extrabold text-gray-900 dark:text-white line-clamp-1">
                                {{ $product->getName() }}
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">
                                {{ $product->getDescription() }}
                            </p>

                            <p class="text-xs text-indigo-600 dark:text-indigo-400 font-bold mt-3">
                                {{ $product->category->getName() ?? __('messages.no_category') }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <p class="text-2xl font-extrabold text-gray-900 dark:text-white">
                                    ₹{{ number_format($product->price) }}
                                </p>
                            </div>

                            <a href="{{ route('products.show', $product->id) }}"
                                class="mt-4 inline-flex items-center justify-center w-full px-5 py-3 rounded-full bg-gray-900 text-white font-bold hover:bg-yellow-400 hover:text-black transition dark:bg-white dark:text-black">
                                    👁 {{ __('messages.view_product') }}
                            </a>

                            <div class="grid grid-cols-2 gap-3 mt-5">

                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <button type="submit"
                                        class="w-full h-11 text-sm bg-black dark:bg-indigo-600 text-white rounded-full font-bold hover:bg-indigo-600 dark:hover:bg-indigo-700 transition">
                                        🛒 {{ __('messages.Add to Cart') }}
                                    </button>
                                </form>

                                <form action="{{ route('buy.now', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="buy_now" value="1">

                                    <button type="submit"
                                        class="w-full h-11 text-sm bg-yellow-400 text-black rounded-full font-bold hover:bg-yellow-500 transition">
                                        ⚡ {{ __('messages.Buy Now') }}
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                @empty
                    <div class="lg:col-span-3 bg-white dark:bg-gray-900 rounded-[2rem] p-12 text-center shadow-sm border border-gray-100 dark:border-gray-800">
                        <div class="text-5xl mb-4">🔍</div>
                        <h3 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                            {{ __('messages.no_products_found') }}
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">
                            {{ __('messages.try_different_filter') }}
                        </p>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            @if ($products->hasPages())
                <div class="mt-14 flex justify-center">
                    <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 shadow-lg rounded-full px-4 py-3 flex items-center gap-2 flex-wrap">

                        @if ($products->onFirstPage())
                            <span class="px-4 py-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 cursor-not-allowed">
                                ← {{ __('messages.previous') }}
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}"
                               class="px-4 py-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-black hover:text-white dark:hover:bg-indigo-600 transition">
                                ← {{ __('messages.previous') }}
                            </a>
                        @endif

                        @php
                            $current = $products->currentPage();
                            $last = $products->lastPage();
                        @endphp

                        @if($current > 3)
                            <a href="{{ $products->url(1) }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                                1
                            </a>

                            @if($current > 4)
                                <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                            @endif
                        @endif

                        @for($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++)
                            @if($i == $current)
                                <span class="w-10 h-10 flex items-center justify-center rounded-full bg-black dark:bg-indigo-600 text-white font-bold">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $products->url($i) }}"
                                   class="w-10 h-10 flex items-center justify-center rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        @if($current < $last - 2)

                            @if($current < $last - 3)
                                <span class="px-2 text-gray-500 dark:text-gray-400">...</span>
                            @endif

                            <a href="{{ $products->url($last) }}"
                               class="w-10 h-10 flex items-center justify-center rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                                {{ $last }}
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}"
                               class="px-4 py-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-black hover:text-white dark:hover:bg-indigo-600 transition">
                                {{ __('messages.next') }} →
                            </a>
                        @else
                            <span class="px-4 py-2 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-400 cursor-not-allowed">
                                {{ __('messages.next') }} →
                            </span>
                        @endif

                    </div>
                </div>
            @endif

        </main>

    </div>

</div>

@endsection
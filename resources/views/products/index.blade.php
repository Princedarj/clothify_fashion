    @extends('layouts.user')

    @section('content')

    <div class="bg-gray-50 min-h-screen">

        <!-- HERO -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
            <div class="max-w-7xl mx-auto px-6 text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-wide">
                    {{ __('messages.Mens Collection') }}
                </h1>
                <p class="text-lg text-gray-300">
                    {{ __('messages.Mens Collection Desc') }}
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar -->
            <div class="bg-white p-6 rounded-2xl shadow-md h-fit sticky top-20">
                <form method="GET" action="{{ route('products.index') }}">

                    <h3 class="font-bold mb-4 text-lg">
                        {{ __('messages.Filter Products') }}
                    </h3>

                    <label class="block mb-2 text-sm font-medium">
                        {{ __('messages.Category') }}
                    </label>
                    <select name="category_id" class="w-full border p-2 rounded mb-4">
                        <option value="">{{ __('messages.All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <label class="block mb-2 text-sm font-medium">
                        {{ __('messages.Min Price') }}
                    </label>
                    <input type="number" name="min_price"
                        class="w-full border rounded-lg p-2 mb-4">

                    <label class="block mb-2 text-sm font-medium">
                        {{ __('messages.Max Price') }}
                    </label>
                    <input type="number" name="max_price"
                        class="w-full border rounded-lg p-2 mb-4">

                    <button type="submit"
                        class="w-full bg-gray-900 text-white py-2 rounded-lg">
                        {{ __('messages.Apply Filter') }}
                    </button>

                </form>
            </div>

            <!-- Products -->
            <div class="lg:col-span-3">

                <!-- Sorting -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600 text-sm">
                        {{ __('messages.Showing') }} {{ $products->total() }} {{ __('messages.Products') }}
                    </p>

                    <form method="GET">
                        <select name="sort" onchange="this.form.submit()"
                                class="border rounded-lg px-4 py-2 text-sm">
                            <option value="">
                                {{ __('messages.Sort Latest') }}
                            </option>
                            <option value="low">
                                {{ __('messages.Price Low to High') }}
                            </option>
                            <option value="high">
                                {{ __('messages.Price High to Low') }}
                            </option>
                        </select>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow border">

                        <div class="bg-gray-100 aspect-[4/5]">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="p-5">

                            <h3 class="text-lg font-semibold">{{ $product->{'name_' . app()->getLocale()} }}</h3>

                            <p class="text-sm text-gray-600">
                                {{ $product->{'description_' . app()->getLocale()} }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $product->category->{'name_' . app()->getLocale()} ?? __('messages.No Category') }}
                            </p>

                            <p class="text-xl font-bold mt-2">
                                ₹{{ $product->price }}
                            </p>

                            <div class="flex gap-2 mt-3">

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-gray-900 text-white px-3 py-1 rounded">
                                        {{ __('messages.Add to Cart') }}
                                    </button>
                                </form>

                                <form action="{{ route('buy.now', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="bg-yellow-500 text-black px-3 py-1 rounded">
                                        {{ __('messages.Buy Now') }}
                                    </button>
                                </form>

                                <button onclick="openModal(...)"
                                    class="border px-3 py-1 rounded">
                                    {{ __('messages.Quick View') }}
                                </button>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="mt-10">
                    {{ $products->withQueryString()->links() }}
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')
    @endsection
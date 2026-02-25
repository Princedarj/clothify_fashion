@extends('layouts.app')

@section('content')

<div class="bg-gray-50 min-h-screen">

    <!-- 🔥 Hero Section -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Men's Collection</h1>
            <p class="text-lg text-gray-300">Discover premium styles crafted for modern men.</p>
        </div>
    </div>

    <!-- 📦 Products Section -->
    <div class="max-w-7xl mx-auto px-6 py-12">

        <!-- Top Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">

            <p class="text-gray-600 text-sm">
                Showing {{ $products->total() }} Products
            </p>

            <form method="GET" action="{{ route('products.index') }}">
                <select name="sort"
                        onchange="this.form.submit()"
                        class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500">

                    <option value="">Sort by: Latest</option>
                    <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>
                        Price: Low to High
                    </option>
                    <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>
                        Price: High to Low
                    </option>

                </select>
            </form>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Sidebar -->
        <div class="bg-white p-6 rounded-2xl shadow-md h-fit">

        <form method="GET" action="{{ route('products.index') }}">

            <h3 class="font-bold mb-4 text-lg">Filter</h3>

            <!-- Category -->
            <label class="block mb-2 text-sm font-medium">Category</label>
            <select name="category_id" class="w-full border p-2 rounded">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <!-- Price -->
            <label class="block mb-2 text-sm font-medium">Min Price</label>
            <input type="number" name="min_price"
                   value="{{ request('min_price') }}"
                   class="w-full border rounded-lg p-2 mb-4">

            <label class="block mb-2 text-sm font-medium">Max Price</label>
            <input type="number" name="max_price"
                   value="{{ request('max_price') }}"
                   class="w-full border rounded-lg p-2 mb-4">

            <button class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-yellow-500 hover:text-black transition">
                Apply Filter
            </button>

        </form>
    </div>

    <!-- Products Section -->
        <div class="lg:col-span-3">

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">

                @foreach($products as $product)
                <div class="bg-gray-100 rounded-2xl shadow-md hover:shadow-xl transition duration-500 overflow-hidden group border border-gray-200">

                    <!-- Product Image -->
                    <div class="relative bg-gray-200 aspect-[4/5] flex items-center justify-center rounded-t-2xl">

                        <div class="w-full h-full overflow-hidden rounded-t-2xl">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                onerror="this.src='https://via.placeholder.com/400x500';"
                                class="h-full w-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110"
                                alt="{{ $product->name }}">
                        </div>

                    </div>

                    <!-- Product Info -->
                    <div class="p-5">

                        <h3 class="text-lg font-semibold text-gray-900 mb-2 truncate">
                            {{ $product->name }}
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ $product->description }}
                        </p>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $product->category->name ?? 'No Category' }}
                        </p>

                        <p class="text-xl font-bold text-gray-900 mb-4">
                            ₹{{ $product->price }}
                        </p>

                        <!-- Buttons -->
                        <div class="flex gap-3">

                            <a href="{{ route('cart.add', $product->id) }}"
                            class="flex-1 text-center bg-gray-900 text-white py-2.5 rounded-lg 
                                    hover:bg-yellow-500 hover:text-black transition duration-300 text-sm font-medium">
                                Add to Cart
                            </a>

                            <a href="{{ route('checkout', $product->id) }}"
                            class="flex-1 text-center bg-yellow-500 text-black py-2.5 rounded-lg 
                                    hover:bg-gray-900 hover:text-white transition duration-300 text-sm font-medium">
                                Buy Now
                            </a>

                            <button onclick="openModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->price }}', '{{ asset('storage/' . $product->image) }}')"
                                class="flex-1 text-center border border-gray-900 py-2.5 rounded-lg 
                                    hover:bg-gray-900 hover:text-white transition duration-300 text-sm font-medium">
                                Quick View
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
        <div id="quickModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-8 rounded-2xl max-w-md w-full relative">

                <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-600 text-xl">&times;</button>

                <img id="modalImage" class="w-full h-64 object-cover rounded-xl mb-4">

                <h2 id="modalTitle" class="text-xl font-bold mb-2"></h2>
                <p id="modalPrice" class="text-lg font-semibold mb-4"></p>
            </div>
        </div>

        <script>
            function openModal(id, name, price, image) {
                document.getElementById('modalTitle').innerText = name;
                document.getElementById('modalPrice').innerText = '₹' + price;
                document.getElementById('modalImage').src = image;
                document.getElementById('quickModal').classList.remove('hidden');
                document.getElementById('quickModal').classList.add('flex');
            }

            function closeModal() {
                document.getElementById('quickModal').classList.add('hidden');
            }
        </script>
@endsection
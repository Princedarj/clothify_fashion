@extends('layouts.user')

@section('content')

<div class="bg-gray-50 min-h-screen">

    <!-- 🔥 Hero Section -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-wide">Men's Collection</h1>
            <p class="text-lg text-gray-300">Premium styles crafted for modern men.</p>
        </div>
    </div>

    <!-- 📦 Products Section -->
    <div class="max-w-7xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Sidebar -->
        <div class="bg-white p-6 rounded-2xl shadow-md h-fit sticky top-20">
            <form method="GET" action="{{ route('products.index') }}">

                <h3 class="font-bold mb-4 text-lg">Filter Products</h3>

                <label class="block mb-2 text-sm font-medium">Category</label>
                <select name="category_id" class="w-full border p-2 rounded mb-4">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label class="block mb-2 text-sm font-medium">Min Price</label>
                <input type="number" name="min_price" value="{{ request('min_price') }}"
                       class="w-full border rounded-lg p-2 mb-4">

                <label class="block mb-2 text-sm font-medium">Max Price</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}"
                       class="w-full border rounded-lg p-2 mb-4">

                <button type="submit"
                    class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-yellow-500 hover:text-black transition duration-300">
                    Apply Filter
                </button>

            </form>
        </div>

        <!-- Product Grid -->
        <div class="lg:col-span-3">

            <!-- Sorting -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600 text-sm">Showing {{ $products->total() }} Products</p>

                <form method="GET" action="{{ route('products.index') }}">
                    <select name="sort" onchange="this.form.submit()"
                            class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-yellow-500">
                        <option value="">Sort by: Latest</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Price: High to Low</option>
                    </select>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition duration-500 overflow-hidden border border-gray-200 group">

                    <!-- Product Image -->
                    <div class="relative bg-gray-100 aspect-[4/5] flex items-center justify-center rounded-t-2xl overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             onerror="this.src='https://via.placeholder.com/400x500';"
                             class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                             alt="{{ $product->name }}">
                    </div>

                    <!-- Product Info -->
                    <div class="p-5 flex flex-col justify-between h-[220px]">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 line-clamp-2 mb-1">{{ $product->description }}</p>
                            <p class="text-sm text-gray-500 mb-2">{{ $product->category->name ?? 'No Category' }}</p>
                        </div>

                        <div>
                            <p class="text-xl font-bold text-gray-900 mb-3">₹{{ $product->price }}</p>

                            <div class="flex gap-2">
                                <!-- Add to Cart -->
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gray-900 text-white py-2 rounded-lg hover:bg-yellow-500 hover:text-black transition duration-300 text-sm font-medium">
                                        Add to Cart
                                    </button>
                                </form>

                                <!-- Buy Now -->
                                <a href="{{ route('checkout', $product->id) }}"
                                   class="flex-1 text-center bg-yellow-500 text-black py-2 rounded-lg hover:bg-gray-900 hover:text-white transition duration-300 text-sm font-medium">
                                    Buy Now
                                </a>

                                <!-- Quick View -->
                                <button onclick="openModal('{{ $product->id }}', '{{ $product->name }}', '{{ $product->price }}', '{{ asset('storage/' . $product->image) }}')"
                                        class="flex-1 text-center border border-gray-900 py-2 rounded-lg hover:bg-gray-900 hover:text-white transition duration-300 text-sm font-medium">
                                    Quick View
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Quick View Modal -->
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
        document.getElementById('quickModal').classList.remove('flex');
    }
</script>

@endsection
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Clothify Fashion 👕
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
<div class="bg-white rounded-xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 p-4 flex flex-col relative group">

    {{-- 🔥 Discount Badge --}}
    <span class="absolute top-3 left-3 z-30 bg-red-500 text-white text-xs px-3 py-1 rounded-full shadow">
        20% OFF
    </span>

    <!-- {{-- ❤️ Wishlist --}}
    <button class="absolute top-3 right-3 z-20 bg-white p-2 rounded-full shadow hover:bg-pink-100 transition">
        ❤️
    </button> -->

    {{-- Product Image --}}
      <div class="w-full h-56 overflow-hidden rounded-lg bg-gray-100">
        <img 
            src="{{ asset('storage/' . $product->image) }}"
            onerror="this.src='https://via.placeholder.com/400x400?text=No+Image';"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    </div>

    {{-- Product Name --}}
    <h3 class="font-semibold text-lg mt-4 line-clamp-1">
        {{ $product->name }}
    </h3>

    <!-- {{-- ⭐ Rating --}}
    <div class="flex items-center text-yellow-400 text-sm mt-1">
        ⭐⭐⭐⭐☆
        <span class="text-gray-500 text-xs ml-2">(120)</span>
    </div> -->

    {{-- Description --}}
    <p class="text-gray-500 text-sm mt-1 line-clamp-2 flex-grow">
        {{ $product->description }}
    </p>

    {{-- 💰 Price Section --}}
    <div class="mt-3">
        <span class="text-xl font-bold text-indigo-600">
            ₹ {{ $product->price }}
        </span>
        <span class="text-sm text-gray-400 line-through ml-2">
            ₹ {{ $product->price + 500 }}
        </span>
    </div>

    {{-- 🟢 Stock Indicator --}}
    <p class="text-green-600 text-sm mt-1 font-medium">
        In Stock
    </p>

    {{-- Add to Cart --}}
    <form method="POST"
          action="{{ route('cart.add', $product->id) }}"
          class="mt-4">
        @csrf

        <div class="flex items-center justify-center gap-3">

            <button type="button"
                onclick="decreaseQty({{ $product->id }})"
                class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded transition">
                −
            </button>

            <input
                type="text"
                id="qty-{{ $product->id }}"
                name="quantity"
                value="1"
                readonly
                class="w-12 text-center border rounded"
            >

            <button type="button"
                onclick="increaseQty({{ $product->id }})"
                class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded transition">
                +
            </button>
        </div>

        <div class="mt-4">
            <button
                type="submit"
                class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-semibold py-2 rounded-lg shadow active:scale-95 transition-all duration-200">
                Add to Cart 🛒
            </button>
        </div>
    </form>

</div>
@endforeach


            </div>

        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        function increaseQty(id) {
            let input = document.getElementById('qty-' + id);
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQty(id) {
            let input = document.getElementById('qty-' + id);
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</x-app-layout>

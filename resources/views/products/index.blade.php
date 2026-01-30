<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Clothify Fashion 👕
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="border rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">

                        {{-- Product Name --}}
                        <h3 class="font-semibold text-lg mb-2">
                            {{ $product->name }}
                        </h3>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm flex-grow">
                            {{ $product->description }}
                        </p>

                        {{-- Price --}}
                        <p class="font-bold text-lg mt-3">
                            ₹ {{ $product->price }}
                        </p>

                        {{-- Add to Cart --}}
                        <form method="POST"
                              action="{{ route('cart.add', $product->id) }}"
                              class="mt-4">
                            @csrf

                            <div class="flex items-center justify-center gap-3">

                                <button type="button"
                                    onclick="decreaseQty({{ $product->id }})"
                                    class="px-3 py-1 bg-red-500 text-white rounded">
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
                                    class="px-3 py-1 bg-green-600 text-white rounded">
                                    +
                                </button>
                            </div>

                            <button
                                class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 rounded">
                                Add to Cart 🛒
                            </button>
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

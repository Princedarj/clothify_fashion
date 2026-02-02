<x-app-layout>
    <div class="p-6 text-center">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-2xl font-bold text-green-600">
            Order Placed Successfully 🎉
        </h1>

        <p class="mt-2">
            Thank you for shopping with Clothify Fashion.
        </p>

        <a href="{{ route('products.index') }}"
           class="inline-block mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
            Continue Shopping
        </a>
    </div>
</x-app-layout>

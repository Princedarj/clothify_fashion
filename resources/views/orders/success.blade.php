<x-app-layout>

    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow text-center">
        <h2 class="text-2xl font-bold text-green-600">
            🎉 Order Placed Successfully
        </h2>

        <p class="mt-4">Thank you for shopping with us.</p>

        <a href="{{ route('products.index') }}"
           class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Continue Shopping
        </a>
    </div>

</x-app-layout>

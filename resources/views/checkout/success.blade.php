<x-app-layout>
    <div class="py-12 max-w-xl mx-auto text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">
            🎉 Order Placed Successfully!
        </h2>

        <p class="text-gray-700 mb-6">
            Thank you for shopping with <strong>Clothify Fashion</strong> 👕  
            Your order will be delivered in 3–5 days.
        </p>

        <a href="{{ route('products.index') }}"
           class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Continue Shopping 🛍️
        </a>
    </div>
</x-app-layout>

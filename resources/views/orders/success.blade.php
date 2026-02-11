<x-app-layout>
<div class="py-8 max-w-3xl mx-auto text-center">

    <h2 class="text-2xl font-bold text-green-600">
        🎉 Order Placed Successfully
    </h2>

    <p class="mt-3">Thank you for shopping with us.</p>

    <div class="flex justify-center gap-4 mt-6">

        <a href="{{ route('products.index') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Continue Shopping
        </a>

        <a href="{{ route('user.orders.invoice', $order->id) }}"
           class="bg-green-600 text-white px-4 py-2 rounded">
            Download Invoice
        </a>

    </div>

</div>
</x-app-layout>

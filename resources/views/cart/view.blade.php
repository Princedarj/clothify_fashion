<x-app-layout>
    <div class="py-12 max-w-4xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Your Cart 🛒</h2>

        @if(empty($cart))
            <p>Your cart is empty.</p>
        @else
           <table class="w-full border text-center">
    <thead>
        <tr class="border bg-gray-100">
            <th class="p-2">Product</th>
            <th class="p-2">Price</th>
            <th class="p-2">Qty</th>
            <th class="p-2">Total</th>
        </tr>
    </thead>

    <tbody>
        @php $grandTotal = 0; @endphp

        @foreach($cart as $id => $item)
            @php
                $total = $item['price'] * $item['quantity'];
                $grandTotal += $total;
            @endphp

            <tr class="border">
                <td class="p-2">{{ $item['name'] }}</td>
                <td class="p-2">₹ {{ $item['price'] }}</td>

                <!-- Qty with + / - -->
                <td class="p-2">
                    <div class="flex justify-center items-center gap-2">
                        <form method="POST" action="{{ route('cart.decrease', $id) }}">
                            @csrf
                            <button class="px-2 bg-red-500 text-white rounded">−</button>
                        </form>

                        <span class="font-bold">{{ $item['quantity'] }}</span>

                        <form method="POST" action="{{ route('cart.increase', $id) }}">
                            @csrf
                            <button class="px-2 bg-green-500 text-white rounded">+</button>
                        </form>
                    </div>
                </td>

                <!-- Total (ONLY ONCE) -->
                <td class="p-2 font-bold">₹ {{ $total }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr class="border bg-gray-100 font-bold">
            <td colspan="3" class="p-2 text-right">Grand Total</td>
            <td class="p-2">₹ {{ $grandTotal }}</td>
        </tr>
    </tfoot>
</table>
<div class="mt-4 flex justify-end">
    <a href="{{ route('checkout') }}"
       class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
        Proceed to Checkout →
    </a>
</div>



        @endif
    </div>
</x-app-layout>

<h2>Thank you for your order!</h2>

<p>Order ID: {{ $order->id }}</p>

<p>Total: ₹{{ $order->total }}</p>

<a href="{{ route('invoice.download', $order->id) }}">
    Download Invoice
</a>
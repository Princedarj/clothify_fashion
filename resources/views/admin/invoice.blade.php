<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{{ __('messages.invoice') }}</title>

<style>
/* (no change in CSS) */
</style>
</head>

<body>

@if($order->status == 'Delivered')
<div class="watermark">{{ __('messages.paid') }}</div>
@endif

<!-- Header -->
<div class="header">
    <div>
        <img src="{{ public_path('uploads/Image/clothify.png') }}" class="logo">
        <p><strong>Clothify Fashions</strong><br>
        123 Fashion Street<br>
        Mumbai, India<br>
        support@clothify.com</p>
    </div>

    <div class="invoice-details">
        <h2>{{ __('messages.invoice') }}</h2>
        <p><strong>{{ __('messages.invoice_no') }}:</strong> INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        <p><strong>{{ __('messages.date') }}:</strong> {{ $order->created_at->format('d M Y') }}</p>
        <p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.' . strtolower($order->status)) }}</p>
    </div>
</div>

<!-- Billing Info -->
<div class="section">
    <h3>{{ __('messages.billing_to') }}</h3>
    <p><strong>{{ $order->name }}</strong><br>
    {{ $order->address }}<br>
    {{ $order->email }}<br>
    {{ $order->phone }}</p>
</div>

<!-- Products Table -->
<div class="section">
    <table>
        <thead>
            <tr>
                <th>{{ __('messages.product') }}</th>
                <th class="text-right">{{ __('messages.price') }}</th>
                <th class="text-right">{{ __('messages.qty') }}</th>
                <th class="text-right">{{ __('messages.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                <td class="text-right">{{ $item->quantity }}</td>
                <td class="text-right">₹{{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Totals -->
<table class="totals">
    <tr>
        <td>{{ __('messages.subtotal') }}:</td>
        <td class="text-right">₹{{ number_format($order->subtotal, 2) }}</td>
    </tr>
    <tr>
        <td>{{ __('messages.gst') }} (18%):</td>
        <td class="text-right">₹{{ number_format($order->tax, 2) }}</td>
    </tr>
    <tr class="grand-total">
        <td>{{ __('messages.grand_total') }}:</td>
        <td class="text-right">₹{{ number_format($order->total_amount, 2) }}</td>
    </tr>
</table>

<div style="clear: both;"></div>

<!-- Footer -->
<div class="footer">
    {{ __('messages.thank_you') }} <strong>Clothify Fashions</strong> ❤️ <br>
    {{ __('messages.invoice_note') }}
</div>

</body>
</html>
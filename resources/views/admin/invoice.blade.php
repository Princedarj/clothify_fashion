<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{{ __('messages.invoice') }}</title>

<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        background: #f4f6f9;
        padding: 20px;
        color: #333;
    }

    .invoice-box {
        max-width: 900px;
        margin: auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        position: relative;
    }

    /* Watermark */
    .watermark {
        position: absolute;
        top: 40%;
        left: 25%;
        font-size: 80px;
        color: rgba(0, 200, 0, 0.1);
        transform: rotate(-30deg);
        font-weight: bold;
        z-index: 0;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .logo {
        width: 120px;
        margin-bottom: 10px;
        border-radius: 70px;

    }

    .invoice-details h2 {
        margin: 0;
        color: #4f46e5;
    }

    .invoice-details p {
        margin: 4px 0;
        font-size: 14px;
    }

    /* Sections */
    .section {
        margin-bottom: 25px;
    }

    .section h3 {
        margin-bottom: 8px;
        color: #111827;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table thead {
        background: #4f46e5;
        color: #fff;
    }

    table th, table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        font-size: 14px;
    }

    table th {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    /* Totals */
    .totals {
        width: 40%;
        float: right;
        margin-top: 20px;
    }

    .totals td {
        padding: 10px;
    }

    .totals tr {
        border-bottom: 1px solid #eee;
    }

    .grand-total {
        font-weight: bold;
        font-size: 18px;
        background: #f9fafb;
    }

    /* Footer */
    .footer {
        margin-top: 40px;
        text-align: center;
        font-size: 13px;
        color: #666;
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

</style>
</head>

<body>

<div class="invoice-box">

@if($order->status == 'Delivered')
<div class="watermark">{{ __('messages.paid') }}</div>
@endif

<!-- Header -->
<div class="header">
    <div>
        <img src="{{ public_path('uploads/Image/clothify.png') }}" class="logo">
        <p>
            <strong>Clothify Fashions</strong><br>
            123 Fashion Street<br>
            Mumbai, India<br>
            support@clothify.com
        </p>
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
    <p>
        <strong>{{ $order->name }}</strong><br>
        {{ $order->address }}<br>
        {{ $order->email }}<br>
        {{ $order->phone }}
    </p>
</div>

<!-- Products -->
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
        <td>{{ __('messages.total_amount') }}:</td>
        <td class="text-right">₹{{ number_format($order->grand_total, 2) }}</td>
    </tr>
</table>

<div style="clear: both;"></div>

<!-- Footer -->
<div class="footer">
    {{ __('messages.thank_you') }} <strong>Clothify Fashions</strong> ❤️ <br>
    {{ __('messages.invoice_note') }}
</div>

</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice</title>

<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 14px;
        color: #1f2937;
        margin: 40px;
        position: relative;
    }

    .watermark {
        position: fixed;
        top: 40%;
        left: 25%;
        font-size: 100px;
        color: rgba(34,197,94,0.15);
        transform: rotate(-30deg);
        z-index: -1;
    }

    .header {
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 15px;
    }

    .logo {
        width: 120px;
    }

    .invoice-details {
        text-align: right;
    }

    .section {
        margin-top: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table th {
        background: #111827;
        color: white;
        padding: 10px;
        text-align: left;
    }

    table td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
    }

    .text-right {
        text-align: right;
    }

    .totals {
        margin-top: 20px;
        width: 40%;
        float: right;
    }

    .totals td {
        padding: 6px 10px;
    }

    .grand-total {
        font-weight: bold;
        font-size: 16px;
        border-top: 2px solid #111827;
    }

    .footer {
        margin-top: 80px;
        text-align: center;
        font-size: 12px;
        color: #6b7280;
        border-top: 1px solid #e5e7eb;
        padding-top: 10px;
    }
</style>
</head>

<body>

@if($order->status == 'Delivered')
<div class="watermark">PAID</div>
@endif

<!-- Header -->
<div class="header">
    <div>
        <img src="{{ public_path('images/logo.png') }}" class="logo">
        <p><strong>Clothify Fashions</strong><br>
        123 Fashion Street<br>
        Mumbai, India<br>
        support@clothify.com</p>
    </div>

    <div class="invoice-details">
        <h2>INVOICE</h2>
        <p><strong>Invoice No:</strong> INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>
</div>

<!-- Billing Info -->
<div class="section">
    <h3>Billing To:</h3>
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
                <th>Product</th>
                <th class="text-right">Price</th>
                <th class="text-right">Qty</th>
                <th class="text-right">Total</th>
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
        <td>Subtotal:</td>
        <td class="text-right">₹{{ number_format($subtotal, 2) }}</td>
    </tr>
    <tr>
        <td>GST (18%):</td>
        <td class="text-right">₹{{ number_format($tax, 2) }}</td>
    </tr>
    <tr class="grand-total">
        <td>Grand Total:</td>
        <td class="text-right">₹{{ number_format($grandTotal, 2) }}</td>
    </tr>
</table>

<div style="clear: both;"></div>

<!-- Footer -->
<div class="footer">
    Thank you for shopping with <strong>Clothify Fashions</strong> ❤️ <br>
    This is a computer generated invoice and does not require signature.
</div>

</body>
</html>
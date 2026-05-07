<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>{{ __('messages.invoice') }}</title>

<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        background: #eef1f5;
        padding: 22px;
        color: #1f2937;
    }

    .invoice-box {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        position: relative;
    }

    .watermark {
        position: absolute;
        top: 42%;
        left: 18%;
        font-size: 95px;
        color: rgba(34, 197, 94, 0.10);
        transform: rotate(-30deg);
        font-weight: bold;
        z-index: 0;
    }

    .brand-watermark {
        position: absolute;
        top: 235px;
        left: 60px;
        font-size: 78px;
        font-weight: bold;
        letter-spacing: 6px;
        color: rgba(17,24,39,0.035);
        z-index: 0;
    }

    .top-header {
        background: #111827;
        color: #ffffff;
        padding: 30px;
        position: relative;
    }

    .top-header::after {
        content: "";
        position: absolute;
        right: -80px;
        top: -80px;
        width: 230px;
        height: 230px;
        background: #4f46e5;
        border-radius: 50%;
        opacity: 0.35;
    }

    .header-table {
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .logo {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: #ffffff;
        padding: 6px;
    }

    .brand-title {
        font-size: 28px;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
    }

    .brand-subtitle {
        margin: 5px 0 0;
        font-size: 13px;
        color: #d1d5db;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .invoice-title {
        font-size: 38px;
        font-weight: bold;
        margin: 0;
        text-align: right;
    }

    .invoice-number {
        margin-top: 6px;
        color: #d1d5db;
        font-size: 14px;
        text-align: right;
    }

    .content {
        padding: 30px;
        position: relative;
        z-index: 1;
    }

    .info-table {
        width: 100%;
        margin-bottom: 25px;
    }

    .info-card {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 18px;
        vertical-align: top;
    }

    .info-card h3 {
        margin: 0 0 10px;
        color: #111827;
        font-size: 16px;
    }

    .info-card p {
        margin: 0;
        color: #4b5563;
        font-size: 13px;
        line-height: 1.7;
    }

    .meta-table {
        width: 100%;
        margin-bottom: 28px;
        border-spacing: 10px;
        border-collapse: separate;
    }

    .meta-box {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px;
    }

    .meta-label {
        font-size: 11px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .meta-value {
        font-size: 15px;
        font-weight: bold;
        color: #111827;
    }

    .status-paid {
        color: #059669;
    }

    .items-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        border: 1px solid #e5e7eb;
    }

    .items-table thead {
        background: #111827;
        color: #ffffff;
    }

    .items-table th {
        padding: 13px;
        font-size: 13px;
        text-align: left;
    }

    .items-table td {
        padding: 13px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 13px;
        color: #374151;
    }

    .items-table tbody tr:nth-child(even) {
        background: #f9fafb;
    }

    .text-right {
        text-align: right;
    }

    .product-name {
        font-weight: bold;
        color: #111827;
    }

    .summary-wrap {
        width: 100%;
        margin-top: 25px;
        page-break-inside: avoid;
        clear: both;
    }

    .summary-table {
        width: 340px;
        float: right;
        border-collapse: collapse;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        page-break-inside: avoid;
    }

    .summary-table td {
        padding: 12px 15px;
        font-size: 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    .summary-label {
        color: #4b5563;
    }

    .summary-value {
        text-align: right;
        font-weight: bold;
        color: #111827;
    }

    .grand-row td {
        background: #111827;
        color: #ffffff;
        font-size: 16px;
        font-weight: bold;
        border-bottom: none;
    }

    .note-box {
        clear: both;
        display: block;
        margin-top: 120px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        padding: 14px 16px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.6;
        page-break-inside: avoid;
        margin-top: 10px;
    }

    .footer {
        background: #111827;
        color: #d1d5db;
        text-align: center;
        padding: 20px;
        font-size: 13px;
    }

    .footer small {
        display: block;
        margin-top: 6px;
        color: #9ca3af;
    }
</style>
</head>

<body>

@php
    $subtotal = $order->subtotal ?? $order->items->sum('total');
    $tax = $order->tax ?? ($subtotal * 0.18);
    $grandTotal = $order->grand_total ?? ($subtotal + $tax);
@endphp

<div class="invoice-box">

@if($order->status == 'Delivered')
    <div class="watermark">{{ __('messages.paid') }}</div>
@endif

<div class="brand-watermark">CLOTHIFY</div>

<div class="top-header">
    <table class="header-table">
        <tr>
            <td width="70">
                <img src="{{ public_path('uploads/Image/clothify.png') }}" class="logo">
            </td>
            <td>
                <h1 class="brand-title">Clothify Fashions</h1>
                <p class="brand-subtitle">Premium Men’s Fashion</p>
            </td>
            <td>
                <h2 class="invoice-title">{{ __('messages.invoice') }}</h2>
                <p class="invoice-number">
                    INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </p>
            </td>
        </tr>
    </table>
</div>

<div class="content">

    <table class="info-table" cellpadding="0" cellspacing="0">
        <tr>
            <td width="48%" class="info-card">
                <h3>{{ __('messages.from') ?? 'From' }}</h3>
                <p>
                    <strong>Clothify Fashions</strong><br>
                    123 Fashion Street<br>
                    Mumbai, India<br>
                    support@clothify.com
                </p>
            </td>

            <td width="4%"></td>

            <td width="48%" class="info-card">
                <h3>{{ __('messages.billing_to') }}</h3>
                <p>
                    <strong>{{ $order->name }}</strong><br>
                    {{ $order->address }}<br>
                    {{ $order->email }}<br>
                    {{ $order->phone }}
                </p>
            </td>
        </tr>
    </table>

    <table class="meta-table">
        <tr>
            <td class="meta-box">
                <div class="meta-label">{{ __('messages.invoice_no') }}</div>
                <div class="meta-value">
                    INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </div>
            </td>

            <td class="meta-box">
                <div class="meta-label">{{ __('messages.date') }}</div>
                <div class="meta-value">
                    {{ $order->created_at->format('d M Y') }}
                </div>
            </td>

            <td class="meta-box">
                <div class="meta-label">{{ __('messages.status') }}</div>
                <div class="meta-value status-paid">
                    {{ __('messages.' . strtolower($order->status)) }}
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
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
                    <td class="product-name">{{ $item->product_name }}</td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">
                        ₹{{ number_format($item->total, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-wrap">
        <table class="summary-table">
            <tr>
                <td class="summary-label">{{ __('messages.subtotal') }}</td>
                <td class="summary-value">
                    ₹{{ number_format($subtotal, 2) }}
                </td>
            </tr>

            <tr>
                <td class="summary-label">{{ __('messages.gst') }} (18%)</td>
                <td class="summary-value">
                    ₹{{ number_format($tax, 2) }}
                </td>
            </tr>

            <tr class="grand-row">
                <td>{{ __('messages.total_amount') }}</td>
                <td class="text-right">
                    ₹{{ number_format($grandTotal, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="note-box">
        {{ __('messages.invoice_note') }}
    </div>

</div>

<div class="footer">
    {{ __('messages.thank_you') }} <strong>Clothify Fashions</strong> ❤️
    <small>© {{ date('Y') }} Clothify Fashions. {{ __('messages.All Rights Reserved') }}</small>
</div>

</div>

</body>
</html>
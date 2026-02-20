<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1f2937;
            font-size: 14px;
            margin: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 15px;
        }

        .logo {
            width: 120px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
        }

        .section {
            margin-top: 25px;
        }

        .section h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #374151;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            background-color: #111827;
            color: #ffffff;
            padding: 10px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #111827;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div>
            <img src="{{ public_path('uploads/Image/Clothify.png') }}" class="logo">
        </div>

        <div>
            <div class="invoice-title">INVOICE</div>
            <div>Order #{{ $order->id }}</div>
            <div>{{ $order->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <!-- Customer Info -->
    <div class="section">
        <h3>Billing Details</h3>
        <div class="info">
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
        </div>
    </div>

    <!-- Product Table -->
    <div class="section">
        <h3>Order Summary</h3>

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

    <!-- Grand Total -->
    <div class="total-box">
        Grand Total: ₹{{ number_format($order->total_amount, 2) }}
    </div>

    <!-- Footer -->
    <div class="footer">
        Thank you for shopping with <strong>Clothify Fashions</strong> ❤️<br>
        www.clothify.com
    </div>

</body>
</html>
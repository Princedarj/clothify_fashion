<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body style="margin:0; padding:0; font-family: Arial, sans-serif; background-color:#f4f4f4;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4; padding:20px;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:10px; overflow:hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="background:#4CAF50; padding:20px; text-align:center; color:white;">
                            <h1 style="margin:0;">🛍️ Clothify Fashion</h1>
                            <p style="margin:5px 0;">Order Confirmation</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:20px;">

                            <!-- Customer Name -->
                            <h2 style="color:#333;">
                                Hello {{ $order->user->name ?? 'Customer' }}, 👋
                            </h2>

                            <p>Thank you for your order! 🎉</p>

                            <p><strong>Order ID:</strong> #{{ $order->id }}</p>

                            <p>
                                <strong>Order Date:</strong>
                                {{ $order->created_at->format('d M Y') }}
                            </p>

                            <p>
                                <strong>Total Amount:</strong>
                                ₹{{ number_format($order->grand_total, 2) }}
                            </p>

                            <hr style="margin:20px 0;">

                            <h3>🧾 Order Details</h3>

                            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse;">

                                <thead>
                                    <tr style="background:#eeeeee; font-weight:bold;">
                                        <th align="left">Product</th>
                                        <th align="center">Qty</th>
                                        <th align="right">Price</th>
                                        <th align="right">Total</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @if($order->items->isEmpty())
                                        <tr>
                                            <td colspan="4" align="center">No items found</td>
                                        </tr>
                                    @endif

                                    @foreach($order->items as $item)
                                        <tr style="border-bottom:1px solid #eee;">
                                            <td>
                                                {{ $item->product_name ?? 'Unknown Product' }}
                                            </td>
                                            <td align="center">
                                                {{ $item->quantity }}
                                            </td>
                                            <td align="right">
                                                ₹{{ number_format($item->price, 2) }}
                                            </td>
                                            <td align="right">
                                                ₹{{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Subtotal -->
                                    <tr>
                                        <td colspan="3" align="right"><strong>Subtotal</strong></td>
                                        <td align="right">₹{{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    <!-- Tax -->
                                    <tr>
                                        <td colspan="3" align="right"><strong>Tax (18%)</strong></td>
                                        <td align="right">₹{{ number_format($order->tax, 2) }}</td>
                                    </tr>

                                </tbody>
                            </table>

                            <hr style="margin:20px 0;">

                            <h3 style="text-align:right;">
                                Grand Total: ₹{{ number_format($order->grand_total, 2) }}
                            </h3>

                            <!-- Invoice Button -->
                            <div style="text-align:center; margin-top:30px;">
                                <a href="{{ route('invoice.download', $order->id) }}"
                                    style="background:#4CAF50; color:white; padding:12px 20px; text-decoration:none; border-radius:5px; font-weight:bold;">
                                    📄 Download Invoice
                                </a>
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f1f1f1; padding:15px; text-align:center; font-size:12px; color:#777;">
                            <p style="margin:0;">Thank you for shopping with us ❤️</p>
                            <p style="margin:5px 0;">© {{ date('Y') }} Your Store. All rights reserved.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
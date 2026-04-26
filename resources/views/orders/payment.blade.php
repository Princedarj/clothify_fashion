@extends('layouts.user')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4">

    <div class="bg-white rounded-2xl shadow-lg p-8 text-center">

        <h2 class="text-3xl font-bold mb-4 text-gray-800">
            Complete Payment
        </h2>

        <p class="text-gray-600 mb-6">
            Order #{{ $order->id }}
        </p>

        <p class="text-2xl font-bold text-green-600 mb-8">
            ₹ {{ number_format($order->total_amount ?? $order->grand_total ?? 0, 2) }}
        </p>

        <button id="payBtn"
            class="bg-indigo-600 text-white px-8 py-3 rounded-xl hover:bg-indigo-700">
            Pay Now
        </button>

    </div>
</div>

<form id="paymentVerifyForm" method="POST" action="{{ route('payment.verify') }}">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.getElementById('payBtn').onclick = function (e) {
    e.preventDefault();

    var options = {
        "key": "{{ $razorpayKey }}",
        "amount": "{{ (int) round(($order->total_amount ?? $order->grand_total ?? 0) * 100) }}",
        "currency": "INR",
        "name": "Clothify Fashion",
        "description": "Order #{{ $order->id }}",
        "order_id": "{{ $order->razorpay_order_id }}",

        "handler": function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;

            document.getElementById('paymentVerifyForm').submit();
        },

        "prefill": {
            "name": "{{ $order->name }}",
            "email": "{{ $order->email }}",
            "contact": "{{ $order->phone }}"
        },

        "theme": {
            "color": "#4f46e5"
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
};
</script>
@endsection
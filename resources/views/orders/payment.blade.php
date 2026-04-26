@extends('layouts.user')

@section('content')

<div class="max-w-4xl mx-auto py-10">

    <div class="bg-white shadow-lg rounded-xl p-8">

        <h2 class="text-3xl font-bold mb-6 text-center">
            Payment Options
        </h2>

        <div class="grid md:grid-cols-2 gap-8">

            <!-- QR Payment -->
            <div class="border rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold mb-4">Scan QR</h3>

                <img src="{{ asset('images/payment-qr.png') }}"
                     class="w-64 mx-auto mb-4">

                <p class="text-gray-600 mb-4">
                    Scan using Google Pay / PhonePe / Paytm
                </p>

                <form method="POST" action="{{ route('payment.success', $order->id) }}">
                    @csrf
                    <input type="hidden" name="payment_method" value="QR">
                    <button class="bg-green-600 text-white px-6 py-2 rounded-lg">
                        Payment Completed
                    </button>
                </form>
            </div>

            <!-- UPI Code -->
            <div class="border rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4">Pay Using UPI ID</h3>

                <p class="mb-2 font-medium">UPI ID:</p>

                <div class="bg-gray-100 p-3 rounded mb-4">
                    clothify@upi
                </div>

                <form method="POST" action="{{ route('payment.success', $order->id) }}">
                @csrf
                <input type="hidden" name="payment_method" value="UPI">

                <input type="text"
                    name="transaction_code"
                    placeholder="Enter transaction code"
                    class="w-full border p-3 rounded mb-4">

                <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
                    Confirm Payment
                </button>
            </form>
            </div>

        </div>

    </div>

</div>

@endsection
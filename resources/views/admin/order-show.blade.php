@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">Order Details</h1>

<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
<p><strong>Total:</strong> ₹{{ $order->total }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>

@endsection

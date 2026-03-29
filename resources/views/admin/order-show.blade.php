@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">{{ __('messages.order_details') }}</h1>

<p><strong>{{ __('messages.order_id') }}:</strong> {{ $order->id }}</p>
<p><strong>{{ __('messages.customer') }}:</strong> {{ $order->user->name ?? __('messages.guest') }}</p>
<p><strong>{{ __('messages.total') }}:</strong> ₹{{ $order->total }}</p>
<p><strong>{{ __('messages.status') }}:</strong> {{ __('messages.' . strtolower($order->status)) }}</p>

@endsection
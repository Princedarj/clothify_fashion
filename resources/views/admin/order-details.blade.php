@extends('layouts.admin')

@section('content')

<div class="min-h-screen p-8">

    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    {{ __('messages.order') }} #{{ $order->id }}
                </h1>
                <p class="text-gray-500 text-sm">
                    {{ __('messages.order_details') }}
                </p>
            </div>

            <a href="{{ route('admin.orders.index') }}"
               class="bg-gray-800 hover:bg-black text-white px-5 py-2 rounded-lg shadow">
                ← {{ __('messages.back') }}
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT SIDE --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-2xl shadow-lg">

                <h2 class="text-lg font-semibold mb-4 border-b pb-2">
                    {{ __('messages.customer_information') }}
                </h2>

                <div class="space-y-3 text-sm text-gray-600">

                    <div>
                        <p class="font-medium text-gray-800">{{ __('messages.name') }}</p>
                        <p>{{ $order->name }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-800">{{ __('messages.email') }}</p>
                        <p>{{ $order->email }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-800">{{ __('messages.phone') }}</p>
                        <p>{{ $order->phone }}</p>
                    </div>

                    <div>
                        <p class="font-medium text-gray-800">{{ __('messages.address') }}</p>
                        <p>{{ $order->address }}</p>
                    </div>

                </div>

                <div class="mt-6 pt-4 border-t">

                    <div class="space-y-2 text-sm">

                        <div class="flex justify-between">
                            <span>{{ __('messages.subtotal') }}</span>
                            <span>₹{{ number_format($order->subtotal ?? 0) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>GST (18%)</span>
                            <span>₹{{ number_format($order->tax ?? 0, 2) }}</span>
                        </div>

                        <div class="flex justify-between font-bold text-lg border-t pt-2">
                            <span>{{ __('messages.total') }}</span>
                            <span>₹{{ number_format($order->grand_total ?? 0, 2) }}</span>
                        </div>

                    </div>

                    <div class="mb-5">
                        <span class="text-sm font-medium">{{ __('messages.status') }}:</span>
                        <span class="ml-2 px-3 py-1 text-xs font-semibold rounded-full
                            {{ $order->status == 'Delivered'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-yellow-100 text-yellow-700' }}">
                            {{ __('messages.' . strtolower($order->status)) }}
                        </span>
                    </div>

                    {{-- Buttons --}}
                    <div class="space-y-3">

                        @if($order->status !== 'Delivered')
                            <form method="POST" action="{{ route('admin.orders.deliver', $order->id) }}">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition shadow">
                                    {{ __('messages.mark_delivered') }}
                                </button>
                            </form>
                        @endif

                        @if($order->status !== 'cancelled')
                            <a href="{{ route('admin.orders.invoice', $order->id) }}"
                               class="block text-center w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition shadow">
                                {{ __('messages.download_invoice') }}
                            </a>
                        @endif

                    </div>

                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg">

                <h2 class="text-lg font-semibold mb-6">
                    {{ __('messages.ordered_items') }}
                </h2>

                <div class="space-y-4">

                    @foreach($order->items as $item)

                        <div class="flex justify-between items-center p-4 border rounded-xl hover:shadow-md transition">

                            <div>
                                <p class="font-semibold text-gray-800">
                                    {{ $item->product->{'name_' . app()->getLocale()} ?? $item->product_name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    ₹{{ number_format($item->price) }} × {{ $item->quantity }}
                                </p>
                            </div>

                            <div class="text-lg font-bold text-gray-800">
                                ₹{{ number_format($item->total) }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
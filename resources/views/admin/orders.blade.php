@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header Card -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-visible">

        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{__('messages.Admin Panel')}}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.orders_management') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    {{__('messages.Manage, filter, export, and view customer orders')}}
                </p>
            </div>

            <div class="flex items-center gap-3">

                <!-- Language -->
                <div class="relative">
                    <button onclick="toggleLangDropdown()"
                        class="bg-white/15 backdrop-blur-md border border-white/20 text-white px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2 hover:bg-white/25 transition">
                        🌐 {{ __('messages.language') }}
                    </button>

                    <div id="langDropdown"
                        class="hidden absolute right-0 mt-3 bg-white shadow-2xl rounded-2xl w-40 z-[999] border overflow-hidden">

                        <a href="{{ route('lang.switch', 'en') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            English
                        </a>

                        <a href="{{ route('lang.switch', 'hi') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            हिंदी
                        </a>

                        <a href="{{ route('lang.switch', 'gu') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            ગુજરાતી
                        </a>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500/90 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-red-600 transition font-semibold">
                        {{ __('messages.logout') }}
                    </button>
                </form>

            </div>

        </div>
    </div>


    <!-- Main Card -->
    <div class="bg-white rounded-3xl shadow-xl border p-8">

        <!-- Filters -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-7 gap-5 mb-8">

        <form method="GET"
            action="{{ route('admin.orders.filter') }}"
            class="contents">

            <input type="text"
                name="search"
                placeholder="{{ __('messages.search_placeholder') }}"
                value="{{ request('search') }}"
                class="xl:col-span-2 border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

            <select name="status"
                    class="border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

                <option value="">{{ __('messages.all_status') }}</option>

                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>
                    {{ __('messages.pending') }}
                </option>

                <option value="Delivered" {{ request('status') == 'Delivered' ? 'selected' : '' }}>
                    {{ __('messages.delivered') }}
                </option>

            </select>

            <select name="payment_status"
                    class="border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

                <option value="">{{__('messages.All Payment')}}</option>

                <option value="Pending" {{ request('payment_status') == 'Pending' ? 'selected' : '' }}>
                    {{__('messages.pending')}}
                </option>

                <option value="Paid" {{ request('payment_status') == 'Paid' ? 'selected' : '' }}>
                    {{__('messages.paid')}}
                </option>

                <option value="Failed" {{ request('payment_status') == 'Failed' ? 'selected' : '' }}>
                    {{__('messages.failed')}}
                </option>

            </select>

            <button type="submit"
                    class="bg-indigo-600 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                {{ __('messages.filter') }}
            </button>

        </form>

        <form method="GET"
            action="{{ route('admin.orders.export') }}">

            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">

            <button type="submit"
                    class="w-full bg-emerald-600 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-emerald-700 transition font-semibold">
                {{ __('messages.export') }}
            </button>

        </form>

    </div>


        <!-- Table -->
        <div class="overflow-x-auto rounded-2xl border">
            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-slate-900 text-white uppercase text-xs tracking-wider">
                        <th class="p-5 text-left">{{ __('messages.id') }}</th>
                        <th class="p-5 text-left">{{ __('messages.customer') }}</th>
                        <th class="p-5 text-left">{{ __('messages.total') }}</th>
                        <th class="p-5 text-left">{{ __('messages.status') }}</th>
                        <th class="p-5 text-left">{{ __('messages.date') }}</th>
                        <th class="p-5 text-left">{{ __('messages.payment') }}</th>
                        <th class="p-5 text-left">{{ __('messages.action') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($orders as $order)

                        <tr class="hover:bg-indigo-50/60 transition duration-200">

                            <td class="p-5 font-bold text-gray-800">
                                #{{ $order->id }}
                            </td>

                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($order->user->name ?? 'G', 0, 1)) }}
                                    </div>

                                    <span class="font-semibold text-gray-700">
                                        {{ $order->user->name ?? 'Guest' }}
                                    </span>
                                </div>
                            </td>

                            <td class="p-5 font-bold text-gray-900">
                                ₹ {{ number_format($order->grand_total ?? 0) }}
                            </td>

                            <td class="p-5">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold
                                    {{ $order->status == 'Delivered'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">

                                    ● {{ __('messages.' . strtolower($order->status)) }}
                                </span>
                            </td>

                            <td class="p-5 text-gray-500 font-medium">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="p-5">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-bold
                                    {{ $order->payment_status == 'Paid'
                                        ? 'bg-green-100 text-green-700'
                                        : ($order->payment_status == 'Failed'
                                            ? 'bg-red-100 text-red-700'
                                            : 'bg-yellow-100 text-yellow-700') }}">

                                    ● {{ $order->payment_status }}
                                </span>
                            </td>

                            <td class="p-5">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-50 text-indigo-700 font-bold hover:bg-indigo-600 hover:text-white transition">
                                    {{ __('messages.view') }}
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-10 text-gray-500">
                                {{ __('messages.no_orders') }}
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>


        <!-- Pagination -->
        <div class="mt-8 flex justify-center">

            @if ($orders->lastPage() > 1)

                <div class="flex flex-col lg:flex-row gap-5 items-center">

                    <div class="flex flex-wrap justify-center gap-2">

                        {{-- Prev --}}
                        @if ($orders->onFirstPage())
                            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                                {{__('messages.previous')}}
                            </span>
                        @else
                            <a href="{{ $orders->previousPageUrl() }}"
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                                {{__('messages.previous')}}
                            </a>
                        @endif

                        {{-- Left dots --}}
                        @if ($orders->currentPage() > 2)
                            <span class="px-3 py-2 text-gray-400">...</span>
                        @endif

                        {{-- Pages --}}
                        @for ($i = max(1, $orders->currentPage()); $i <= min($orders->lastPage(), $orders->currentPage() + 2); $i++)

                            @if ($i == $orders->currentPage())
                                <span class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold shadow">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $orders->url($i) }}"
                                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                                    {{ $i }}
                                </a>
                            @endif

                        @endfor

                        {{-- Right dots --}}
                        @if ($orders->currentPage() + 2 < $orders->lastPage())
                            <span class="px-3 py-2 text-gray-400">...</span>
                        @endif

                        {{-- Next --}}
                        @if ($orders->hasMorePages())
                            <a href="{{ $orders->nextPageUrl() }}"
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                                {{__('messages.next')}}
                            </a>
                        @else
                            <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                                {{__('messages.next')}}
                            </span>
                        @endif

                    </div>

                    {{-- Go to Page --}}
                    <form method="GET" action="{{ url()->current() }}" class="flex gap-2">

                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="status" value="{{ request('status') }}">
                        <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">

                        <input type="number"
                               name="page"
                               min="1"
                               max="{{ $orders->lastPage() }}"
                               placeholder="{{ __('messages.page') }}"
                               class="border border-gray-200 bg-gray-50 px-3 py-2 rounded-xl w-24 focus:ring-2 focus:ring-indigo-500 outline-none">

                        <button class="px-4 py-2 bg-slate-900 text-white rounded-xl hover:bg-indigo-700 transition font-semibold">
                            {{__('messages.go')}}
                        </button>

                    </form>

                </div>

            @endif

        </div>

    </div>

</div>


<script>
    function toggleLangDropdown() {
        document.getElementById('langDropdown').classList.toggle('hidden');
    }
</script>

@endsection
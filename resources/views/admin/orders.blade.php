@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="bg-white rounded-xl shadow-md p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

    <!-- Left: Title -->
    <h2 class="text-2xl font-semibold text-gray-800">
        {{ __('messages.orders_management') }}
    </h2>

    <!-- Right: Language + Logout -->
    <div class="flex items-center gap-3">

        <!-- 🌐 Language Dropdown -->
        <div class="relative">
            <button onclick="toggleLangDropdown()" 
                class="bg-gray-100 px-4 py-2 rounded-lg shadow hover:bg-gray-200">
                🌐 {{ __('messages.language') }}
            </button>

            <div id="langDropdown" 
                class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-32 z-50">

                <a href="{{ route('lang.switch', 'en') }}" 
                   class="block px-4 py-2 hover:bg-gray-100">English</a>

                <a href="{{ route('lang.switch', 'hi') }}" 
                   class="block px-4 py-2 hover:bg-gray-100">हिंदी</a>

                <a href="{{ route('lang.switch', 'gu') }}" 
                   class="block px-4 py-2 hover:bg-gray-100">ગુજરાતી</a>
            </div>
        </div>

        <!--  Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                 {{ __('messages.logout') }}
            </button>
        </form>

    </div>

</div>

        <form method="GET" class="flex gap-3 mb-4">

            <input type="text" name="search"
                placeholder="{{ __('messages.search_placeholder') }}"
                value="{{ request('search') }}"
                class="border px-3 py-2 rounded">

            <select name="status" class="border px-7 py-2 rounded">
                <option value="">{{ __('messages.all_status') }}</option>
                <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>
                    {{ __('messages.pending') }}
                </option>
                <option value="Delivered" {{ request('status')=='Delivered'?'selected':'' }}>
                    {{ __('messages.delivered') }}
                </option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ __('messages.filter') }}
            </button>

            <a href="{{ route('admin.orders.export') }}"
               class="bg-green-600 text-white px-4 py-2 rounded">
               {{ __('messages.export') }}
            </a>

        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
                        <th class="p-3">
                            {{ __('messages.order_id') }}
                        </th>
                        <th class="p-3">{{ __('messages.customer') }}</th>
                        <th class="p-3">{{ __('messages.total') }}</th>
                        <th class="p-3">{{ __('messages.status') }}</th>
                        <th class="p-3">{{ __('messages.date') }}</th>
                        <th class="p-3">{{ __('messages.action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @if($orders->count() > 0)

                        @foreach($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">{{ $order->id }}</td>
                            <td class="p-3">{{ $order->user->name ?? __('messages.guest') }}</td>
                            <td class="p-3">₹ {{ number_format($order->total_amount ?? 0) }}</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    {{ $order->status == 'Delivered' ? 'bg-green-100 text-green-700' :
                                    ($order->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                                    'bg-gray-100 text-gray-700') }}">
                                    {{ __('messages.' . strtolower($order->status)) }}
                                </span>
                            </td>
                            <td class="p-3">
                                {{ $order->created_at->format('d M Y') }}
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                class="text-indigo-600 hover:underline">
                                    {{ __('messages.view') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    @elseif(request()->search)

                        <tr>
                            <td colspan="6" class="text-center p-6 text-red-600 font-semibold">
                                {{ __('messages.no_match_found') }}
                            </td>
                        </tr>

                    @else

                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500">
                                {{ __('messages.no_orders') }}
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>
        </div>

    </div>
</div>

  <div class="mt-6 flex justify-center">
        @if ($orders->lastPage() > 1)

<div class="flex gap-4 items-center mt-6">

    {{-- Pagination Buttons --}}
    <div class="flex gap-2">

        {{-- Prev --}}
        @if ($orders->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 rounded">Prev</span>
        @else
            <a href="{{ $orders->previousPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Prev</a>
        @endif

        {{-- Left dots --}}
        @if ($orders->currentPage() > 2)
            <span>...</span>
        @endif

        {{-- Pages --}}
        @for ($i = max(1, $orders->currentPage()); $i <= min($orders->lastPage(), $orders->currentPage() + 2); $i++)
            @if ($i == $orders->currentPage())
                <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $i }}</span>
            @else
                <a href="{{ $orders->url($i) }}" class="px-3 py-1 bg-gray-300 rounded">{{ $i }}</a>
            @endif
        @endfor

        {{-- Right dots --}}
        @if ($orders->currentPage() + 2 < $orders->lastPage())
            <span>...</span>
        @endif

        {{-- Next --}}
        @if ($orders->hasMorePages())
            <a href="{{ $orders->nextPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-200 rounded">Next</span>
        @endif

    </div>

    {{-- 🔹 Go to Page --}}
    <form method="GET" action="{{ url()->current() }}" class="flex gap-2">
        <input 
            type="number" 
            name="page" 
            min="1" 
            max="{{ $orders->lastPage() }}" 
            placeholder="Page"
            class="border px-2 py-1 rounded w-20"
        >
        <button class="px-2 py-1 bg-blue-500 text-white rounded">Go</button>
    </form>

</div>

@endif
    </div>

<script>
function toggleLangDropdown() {
    document.getElementById('langDropdown').classList.toggle('hidden');
}
</script>

@endsection

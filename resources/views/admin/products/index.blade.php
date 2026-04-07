@extends('layouts.admin')

@section('content')

<div class="bg-white p-6 rounded-xl shadow-sm">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">

        <!-- Left: Title -->
        <h2 class="text-2xl font-semibold text-gray-800">
            {{ __('messages.orders_management') }}
        </h2>

        <!-- Right: Language + Logout -->
        <div class="flex items-center gap-3">

            <a href="{{ route('admin.products.create') }}"
                class="px-5 py-2 rounded-lg text-white font-medium shadow-md 
                        bg-gradient-to-r from-indigo-500 to-purple-600 
                        hover:from-indigo-600 hover:to-purple-700 
                        transition duration-200 flex items-center gap-2">

                    <span class="text-lg">+</span>
                    <span>{{ __('messages.add_product') }}</span>
            </a>

            <!-- 🌐 Language -->
            <div class="relative flex items-center">

                <button onclick="toggleLangDropdown()" 
                    class="bg-gray-100 px-4 py-2 flex items-center rounded-lg shadow hover:bg-gray-200">

                    <span class="flex items-center gap-2 leading-none">
                        <span>🌐</span>
                        <span>{{ __('messages.language') }}</span>
                    </span>

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

            <!--  Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 flex items-center rounded-lg hover:bg-red-600 leading-none">

                    <span class="flex items-center gap-2">
                        <span>{{ __('messages.logout') }}</span>
                    </span>

                </button>
            </form>

        </div>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                    <th class="p-3 text-left">{{ __('messages.product_name') }}</th>
                    <th class="p-3 text-left">{{ __('messages.price') }}</th>
                    <th class="p-3 text-center">{{ __('messages.action') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($products as $product)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 font-medium">
                        {{ $product->getName() }}
                    </td>
                    <td class="p-3">
                        ₹ {{ number_format($product->price, 2) }}
                    </td>
                    <td class="p-3 text-center">

                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-md text-sm hover:bg-blue-200 transition">
                           {{ __('messages.edit') }}
                        </a>

                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              class="inline-block ml-2"
                              onsubmit="return confirm('{{ __('messages.delete_product_confirm') }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-100 text-red-600 px-3 py-1 rounded-md text-sm hover:bg-red-200 transition">
                                {{ __('messages.delete') }}
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach

                @if($products->isEmpty())
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        {{ __('messages.no_products') }}
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        @if ($products->lastPage() > 1)

<div class="flex gap-4 items-center mt-6">

    {{-- Pagination Buttons --}}
    <div class="flex gap-2">

        {{-- Prev --}}
        @if ($products->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 rounded">Prev</span>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Prev</a>
        @endif

        {{-- Left dots --}}
        @if ($products->currentPage() > 2)
            <span>...</span>
        @endif

        {{-- Pages --}}
        @for ($i = max(1, $products->currentPage()); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
            @if ($i == $products->currentPage())
                <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $i }}</span>
            @else
                <a href="{{ $products->url($i) }}" class="px-3 py-1 bg-gray-300 rounded">{{ $i }}</a>
            @endif
        @endfor

        {{-- Right dots --}}
        @if ($products->currentPage() + 2 < $products->lastPage())
            <span>...</span>
        @endif

        {{-- Next --}}
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Next</a>
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
            max="{{ $products->lastPage() }}" 
            placeholder="Page"
            class="border px-2 py-1 rounded w-20"
        >
        <button class="px-2 py-1 bg-blue-500 text-white rounded">Go</button>
    </form>

</div>

@endif
    </div>

</div>

<script>
function toggleLangDropdown() {
    document.getElementById('langDropdown').classList.toggle('hidden');
}
</script>
@endsection
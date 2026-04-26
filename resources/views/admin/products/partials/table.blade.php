<div class="overflow-x-auto">
    <table class="w-full border-collapse table-fixed text-sm">

        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase">
                <th class="p-3 w-16 text-left">No.</th>
                <th class="p-3 w-1/4 text-left">{{ __('messages.product_name') }}</th>
                <th class="p-3 w-24 text-left">{{ __('messages.image') }}</th>
                <th class="p-3 w-32 text-left">{{ __('messages.price') }}</th>
                <th class="p-3 w-40 text-left">{{ __('messages.category') }}</th>
                <th class="p-3 w-40 text-center">{{ __('messages.action') }}</th>
            </tr>
        </thead>

        <tbody class="text-gray-700">
            @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50 transition">

                    <td class="p-3 text-gray-500">
                        {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                    </td>

                    <td class="p-3 font-medium truncate">
                        {{ $product->getName() }}
                    </td>

                    <td class="p-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-14 h-14 object-cover rounded-lg border hover:scale-110 transition">
                        @else
                            <span class="text-gray-400 text-xs">No Image</span>
                        @endif
                    </td>

                    <td class="p-3">
                        ₹ {{ number_format($product->price, 2) }}
                    </td>

                    <td class="p-3 truncate">
                        {{ $product->category?->{'name_' . app()->getLocale()} ?? $product->category?->name_en ?? '-' }}
                    </td>

                    <td class="p-3 text-center">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">
                                {{ __('messages.edit') }}
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('{{ __('messages.delete_product_confirm') }}')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-400">
                        🚫 {{ __('messages.no_products') }}
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>

<!-- Pagination same style -->
<!-- Pagination premium style -->
<div class="mt-8 flex justify-center ajax-pagination">

    @if ($products->lastPage() > 1)

        <div class="flex flex-col lg:flex-row justify-center items-center gap-5">

            <div class="flex flex-wrap justify-center gap-2">

                {{-- Prev --}}
                @if ($products->onFirstPage())
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                        Prev
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                        Prev
                    </a>
                @endif

                {{-- Left dots --}}
                @if ($products->currentPage() > 2)
                    <span class="px-3 py-2 text-gray-400">...</span>
                @endif

                {{-- Pages --}}
                @for ($i = max(1, $products->currentPage()); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)

                    @if ($i == $products->currentPage())
                        <span class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold shadow">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $products->url($i) }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                            {{ $i }}
                        </a>
                    @endif

                @endfor

                {{-- Right dots --}}
                @if ($products->currentPage() + 2 < $products->lastPage())
                    <span class="px-3 py-2 text-gray-400">...</span>
                @endif

                {{-- Next --}}
                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                        Next
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                        Next
                    </span>
                @endif

            </div>

            <!-- Go to Page -->
            <form method="GET" action="{{ url()->current() }}" class="flex gap-2">

                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">

                <input type="number"
                       name="page"
                       min="1"
                       max="{{ $products->lastPage() }}"
                       placeholder="Page"
                       class="border border-gray-200 bg-gray-50 px-3 py-2 rounded-xl w-24 focus:ring-2 focus:ring-indigo-500 outline-none">

                <button type="submit"
                        class="px-4 py-2 bg-slate-900 text-white rounded-xl hover:bg-indigo-700 transition font-semibold">
                    Go
                </button>

            </form>

        </div>

    @endif

</div>
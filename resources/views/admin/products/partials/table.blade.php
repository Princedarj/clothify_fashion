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
<div class="mt-6 flex justify-center ajax-pagination">
    @if ($products->lastPage() > 1)

        <div class="flex gap-4 items-center mt-6">

            <div class="flex gap-2">

                @if ($products->onFirstPage())
                    <span class="px-3 py-1 bg-gray-200 rounded">Prev</span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Prev</a>
                @endif

                @if ($products->currentPage() > 2)
                    <span>...</span>
                @endif

                @for ($i = max(1, $products->currentPage()); $i <= min($products->lastPage(), $products->currentPage() + 2); $i++)
                    @if ($i == $products->currentPage())
                        <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $i }}</span>
                    @else
                        <a href="{{ $products->url($i) }}" class="px-3 py-1 bg-gray-300 rounded">{{ $i }}</a>
                    @endif
                @endfor

                @if ($products->currentPage() + 2 < $products->lastPage())
                    <span>...</span>
                @endif

                @if ($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Next</a>
                @else
                    <span class="px-3 py-1 bg-gray-200 rounded">Next</span>
                @endif

            </div>

            <form method="GET" action="{{ url()->current() }}" class="flex gap-2">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">

                <input type="number"
                       name="page"
                       min="1"
                       max="{{ $products->lastPage() }}"
                       placeholder="Page"
                       class="border px-2 py-1 rounded w-20">

                <button class="px-2 py-1 bg-blue-500 text-white rounded">Go</button>
            </form>

        </div>

    @endif
</div>
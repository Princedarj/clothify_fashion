<div class="overflow-x-auto rounded-2xl border">
    <table class="w-full text-sm table-auto">

        <thead>
            <tr class="bg-slate-900 text-white uppercase text-xs tracking-wider">
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.user_id') }}</th>
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.name') }}</th>
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.email') }}</th>
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.phone') }}</th>
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.city') }}</th>
                <th class="p-5 text-left whitespace-nowrap">{{ __('messages.total_orders') }}</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">

            @forelse($users as $user)
                <tr class="hover:bg-indigo-50/60 transition duration-200">

                    <td class="px-3 py-3 whitespace-nowrap font-bold text-gray-800">
                        #{{ $user->id }}
                    </td>

                    <td class="px-3 py-3 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                                {{ mb_strtoupper(mb_substr($user->name, 0, 1, 'UTF-8'), 'UTF-8') }}
                            </div>

                            <span class="font-semibold text-gray-700">
                                {{ $user->name }}
                            </span>
                        </div>
                    </td>

                    <td class="px-3 py-3 whitespace-nowrap text-gray-600 font-medium">
                        {{ $user->email }}
                    </td>

                    <td class="px-3 py-3 whitespace-nowrap text-gray-600">
                        {{ $user->phone ?? __('messages.not_available') }}
                    </td>

                    <td class="px-3 py-3 whitespace-nowrap text-gray-600">
                        {{ $user->city ?? __('messages.not_available') }}
                    </td>

                    <td class="px-3 py-3 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">
                            {{ $user->orders_count }}
                        </span>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-10 text-center text-gray-500">
                        {{ __('messages.no_users_found') }}
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>
</div>


<!-- PAGINATIONS -->

@if ($users->lastPage() > 1)

<div class="mt-8 flex justify-center ajax-pagination">

    <div class="flex flex-col lg:flex-row justify-center items-center gap-5">

        <div class="flex flex-wrap justify-center gap-2">

            {{-- Prev --}}
            @if ($users->onFirstPage())
                <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                    {{__('messages.previous')}}
                </span>
            @else
                <a href="{{ $users->previousPageUrl() }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                    {{__('messages.previous')}}
                </a>
            @endif

            {{-- Left dots --}}
            @if ($users->currentPage() > 2)
                <span class="px-3 py-2 text-gray-400">...</span>
            @endif

            {{-- Pages --}}
            @for ($i = max(1, $users->currentPage()); $i <= min($users->lastPage(), $users->currentPage() + 2); $i++)

                @if ($i == $users->currentPage())
                    <span class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold shadow">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $users->url($i) }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                        {{ $i }}
                    </a>
                @endif

            @endfor

            {{-- Right dots --}}
            @if ($users->currentPage() + 2 < $users->lastPage())
                <span class="px-3 py-2 text-gray-400">...</span>
            @endif

            {{-- Next --}}
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                    {{__('messages.next')}}
                </a>
            @else
                <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                    {{__('messages.next')}}
                </span>
            @endif

        </div>

        <!-- Go to Page -->
        <form method="GET" action="{{ url()->current() }}" class="flex gap-2">

            <input type="hidden" name="search_type" value="{{ request('search_type') }}">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="min_orders" value="{{ request('min_orders') }}">

            <input type="number"
                   name="page"
                   min="1"
                   max="{{ $users->lastPage() }}"
                   placeholder="{{ __('messages.page') }}"
                   class="border border-gray-200 bg-gray-50 px-3 py-2 rounded-xl w-24 focus:ring-2 focus:ring-indigo-500 outline-none">

            <button type="submit"
                    class="px-4 py-2 bg-slate-900 text-white rounded-xl hover:bg-indigo-700 transition font-semibold">
                {{__('messages.go')}}
            </button>

        </form>

    </div>

</div>

@endif
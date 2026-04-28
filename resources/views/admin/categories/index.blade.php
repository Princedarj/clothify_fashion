@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header Card -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-visible">

        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.Admin Panel') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.manage_categories') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    {{ __('messages.total_categories') }}: {{ $categories->total() }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <!-- Add Category -->
                <a href="{{ route('admin.categories.create') }}"
                   class="bg-white text-indigo-700 px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-50 transition font-bold flex items-center gap-2">
                    <span class="text-xl">+</span>
                    <span>{{ __('messages.add_category') }}</span>
                </a>

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
                            {{ __('messages.english') }}
                        </a>

                        <a href="{{ route('lang.switch', 'hi') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            {{ __('messages.hindi') }}
                        </a>

                        <a href="{{ route('lang.switch', 'gu') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            {{ __('messages.gujarati') }}
                        </a>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500/90 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-red-600 transition font-semibold">
                        {{ __('messages.logout') }}
                    </button>
                </form>

            </div>
        </div>
    </div>


    <!-- Main Card -->
    <div class="bg-white rounded-3xl shadow-xl border p-8">

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto rounded-2xl border">
            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-slate-900 text-white uppercase text-xs tracking-wider">
                        <th class="p-5 text-left">#</th>
                        <th class="p-5 text-left">{{ __('messages.category_name') }}</th>
                        <th class="p-5 text-left">{{ __('messages.products') }}</th>
                        <th class="p-5 text-right">{{ __('messages.action') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($categories as $category)
                        <tr class="hover:bg-indigo-50/60 transition duration-200">

                            <td class="p-5 font-bold text-gray-800">
                                #{{ $category->id }}
                            </td>

                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white flex items-center justify-center font-bold">
                                        {{ mb_strtoupper(mb_substr($category->getName(), 0, 1, 'UTF-8'), 'UTF-8') }}
                                    </div>

                                    <span class="font-semibold text-gray-700">
                                        {{ $category->getName() }}
                                    </span>
                                </div>
                            </td>

                            <td class="p-5">
                                <span class="inline-flex items-center justify-center px-4 py-2 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">
                                    {{ $category->products()->count() }}
                                </span>
                            </td>

                            <td class="p-5 text-right">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                      method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-5 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-600 hover:text-white transition font-bold">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-500">
                                {{ __('messages.no_categories_found') }}
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>


        <!-- Pagination -->
        @if ($categories->lastPage() > 1)

            <div class="mt-8 flex flex-col lg:flex-row justify-center items-center gap-5">

                <div class="flex flex-wrap justify-center gap-2">

                    {{-- Prev --}}
                    @if ($categories->onFirstPage())
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                            {{ __('messages.previous') }}
                        </span>
                    @else
                        <a href="{{ $categories->previousPageUrl() }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                            {{ __('messages.previous') }}
                        </a>
                    @endif

                    {{-- Left dots --}}
                    @if ($categories->currentPage() > 2)
                        <span class="px-3 py-2 text-gray-400">...</span>
                    @endif

                    {{-- Pages --}}
                    @for ($i = max(1, $categories->currentPage()); $i <= min($categories->lastPage(), $categories->currentPage() + 2); $i++)

                        @if ($i == $categories->currentPage())
                            <span class="px-4 py-2 bg-indigo-600 text-white rounded-xl font-bold shadow">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ $categories->url($i) }}"
                               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                                {{ $i }}
                            </a>
                        @endif

                    @endfor

                    {{-- Right dots --}}
                    @if ($categories->currentPage() + 2 < $categories->lastPage())
                        <span class="px-3 py-2 text-gray-400">...</span>
                    @endif

                    {{-- Next --}}
                    @if ($categories->hasMorePages())
                        <a href="{{ $categories->nextPageUrl() }}"
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-indigo-600 hover:text-white transition font-semibold">
                            {{ __('messages.next') }}
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-100 text-gray-400 rounded-xl font-semibold">
                            {{ __('messages.next') }}
                        </span>
                    @endif

                </div>

                <!-- Go to Page -->
                <form method="GET" action="{{ url()->current() }}" class="flex gap-2">
                    <input type="number"
                           name="page"
                           min="1"
                           max="{{ $categories->lastPage() }}"
                           placeholder="{{ __('messages.page') }}"
                           class="border border-gray-200 bg-gray-50 px-3 py-2 rounded-xl w-24 focus:ring-2 focus:ring-indigo-500 outline-none">

                    <button type="submit"
                            class="px-4 py-2 bg-slate-900 text-white rounded-xl hover:bg-indigo-700 transition font-semibold">
                        {{ __('messages.go') }}
                    </button>
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
@extends('layouts.admin')

@section('content')

<div class="bg-gray-100 min-h-screen p-6">

    <div class="bg-white rounded-2xl shadow-md p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <!-- Left: Title -->
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('messages.manage_categories') }}
            </h2>

            <!-- Right: Actions -->
            <div class="flex items-center gap-3">

                <!-- ➕ Add Category -->
                <a href="{{ route('admin.categories.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow flex items-center">
                    + {{ __('messages.add_category') }}
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

                <!-- 🚪 Logout -->
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

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <th class="p-4">#</th>
                        <th class="p-4">{{ __('messages.category_name') }}</th>
                        <th class="p-4">{{ __('messages.products') }}</th>
                        <th class="p-4 text-right">{{ __('messages.action') }}</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach($categories as $category)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="p-4">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-4 font-medium text-gray-800">
                            {{ $category->getName() }}
                        </td>

                        <td class="p-4">
                            {{ $category->products()->count() }}
                        </td>

                        <td class="p-4 text-right">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('{{ __('messages.delete_confirm') }}')">

                                @csrf
                                @method('DELETE')

                                <button class="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            @if ($categories->lastPage() > 1)

<div class="flex gap-4 items-center mt-6">

    {{-- Pagination Buttons --}}
    <div class="flex gap-2">

        {{-- Prev --}}
        @if ($categories->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 rounded">Prev</span>
        @else
            <a href="{{ $categories->previousPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Prev</a>
        @endif

        {{-- Left dots --}}
        @if ($categories->currentPage() > 2)
            <span>...</span>
        @endif

        {{-- Pages --}}
        @for ($i = max(1, $categories->currentPage()); $i <= min($categories->lastPage(), $categories->currentPage() + 2); $i++)
            @if ($i == $categories->currentPage())
                <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $i }}</span>
            @else
                <a href="{{ $categories->url($i) }}" class="px-3 py-1 bg-gray-300 rounded">{{ $i }}</a>
            @endif
        @endfor

        {{-- Right dots --}}
        @if ($categories->currentPage() + 2 < $categories->lastPage())
            <span>...</span>
        @endif

        {{-- Next --}}
        @if ($categories->hasMorePages())
            <a href="{{ $categories->nextPageUrl() }}" class="px-3 py-1 bg-gray-300 rounded">Next</a>
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
            max="{{ $categories->lastPage() }}" 
            placeholder="Page"
            class="border px-2 py-1 rounded w-20"
        >
        <button class="px-2 py-1 bg-blue-500 text-white rounded">Go</button>
    </form>

</div>

@endif
        </div>

    </div>

</div>

@endsection
@extends('layouts.admin')

@section('content')

<div class="bg-gray-100 min-h-screen p-6">

    <div class="bg-white rounded-2xl shadow-md p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ __('messages.manage_categories') }}
            </h2>

            <a href="{{ route('admin.categories.create') }}"
               class="px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow">
                + {{ __('messages.add_category') }}
            </a>
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
                            {{ $category->name }}
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
            {{ $categories->links() }}
        </div>

    </div>

</div>

@endsection
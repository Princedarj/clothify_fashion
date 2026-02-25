@extends('layouts.admin')

@section('content')

<div class="max-w-xl mx-auto bg-white shadow-lg rounded-xl p-8">

    <h2 class="text-xl font-bold mb-6 text-gray-800">
        ➕ Add Category
    </h2>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-2 font-semibold text-gray-700">
                Category Name
            </label>

            <input type="text"
                   name="name"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500"
                   required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.categories.index') }}"
               class="px-5 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                ← Back
            </a>

            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Save Category
            </button>
        </div>

    </form>

</div>

@endsection
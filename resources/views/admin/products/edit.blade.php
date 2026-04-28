@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex justify-between items-center gap-4">
            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.Admin Panel') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white">
                    {{ __('messages.edit_product') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    <p class="text-slate-300 mt-2">
                        {{ __('messages.edit_product_subtitle') }}
                    </p>
                </p>
            </div>
        </div>
    </div>


    <!-- Form Card -->
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border p-8">

        <form id="productUpdateForm"
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.product_name') }}
                </label>

                <input type="text"
                       name="name"
                       value="{{ $product->getName() }}"
                       class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>


            <!-- Category + Price -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.category') }}
                    </label>

                    <select name="category_id"
                            class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

                        <option value="">{{ __('messages.select_category') }}</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->getName() }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.price') }} (₹)
                    </label>

                    <input type="number"
                           name="price"
                           value="{{ $product->price }}"
                           class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                </div>

            </div>


            <!-- Description -->
            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.description') }}
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">{{ $product->getDescription() }}</textarea>
            </div>


            <!-- Image -->
            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.current_image') }}
                </label>

                <div class="border-2 border-dashed border-indigo-200 bg-indigo-50/50 rounded-3xl p-6">

                    @if($product->image)
                        <div class="mb-5 bg-white rounded-2xl p-4 border inline-block">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="h-40 w-40 object-contain rounded-xl">
                        </div>
                    @else
                        <p class="text-gray-500 mb-4">
                            {{ __('messages.no_image_uploaded') }}
                        </p>
                    @endif

                    <input type="file"
                           name="image"
                           accept=".jpg,.jpeg,.png"
                           class="w-full bg-white border border-gray-200 rounded-2xl p-3">
                </div>

                <p class="text-xs text-gray-500 mt-2">
                    {{ __('messages.replace_image_note') }}
                </p>
            </div>


            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition font-semibold">
                    ← {{ __('messages.back') }}
                </a>

                <button type="submit"
                        id="updateBtn"
                        class="flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                    <span id="updateText">🔄 {{ __('messages.update_product') }}</span>
                    <span id="updateLoader" class="hidden">
                        ⏳ {{ __('messages.updating') ?? 'Updating...' }}
                    </span>
                </button>

            </div>

        </form>

    </div>

</div>

<script>
document.getElementById('productUpdateForm').addEventListener('submit', function () {
    const btn = document.getElementById('updateBtn');
    const text = document.getElementById('updateText');
    const loader = document.getElementById('updateLoader');

    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');

    text.classList.add('hidden');
    loader.classList.remove('hidden');
});
</script>

@endsection
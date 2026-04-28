@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-hidden">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                {{ __('messages.Admin Panel') }}
            </p>

            <h2 class="text-4xl font-extrabold text-white flex items-center gap-3">
                📦 {{ __('messages.add_product') }}
            </h2>

            <p class="text-slate-300 mt-2">
                {{ __('messages.add_product_subtitle') }}
            </p>
        </div>
    </div>


    <!-- Form Card -->
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl border p-8">

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-5 mb-6 rounded-2xl">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>⚠ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="productForm"
              action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-6">

            @csrf

            <!-- Product Name -->
            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.product_name') }}
                </label>

                <input type="text"
                       name="name"
                       placeholder="{{ __('messages.enter_product_name') }}"
                       required
                       class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>


            <!-- Category + Price -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.category') }}
                    </label>

                    <select name="category_id"
                            required
                            class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

                        <option value="">{{ __('messages.select_category') }}</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->getName() ?? $category->name_en }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- Price -->
                <div>
                    <label class="block mb-2 font-bold text-gray-700">
                        {{ __('messages.price') }} (₹)
                    </label>

                    <input type="number"
                           placeholder="{{ __('messages.enter_price') }}"
                           required
                           placeholder="Enter price"
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
                          required
                          placeholder="{{ __('messages.write_product_description') }}"
                          class="w-full border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"></textarea>
            </div>


            <!-- Image -->
            <div>
                <label class="block mb-2 font-bold text-gray-700">
                    {{ __('messages.product_image') }}
                </label>

                <div class="border-2 border-dashed border-indigo-200 bg-indigo-50/50 rounded-3xl p-6">
                    <input type="file"
                           name="image"
                           accept=".jpg,.jpeg,.png"
                           required
                           class="w-full bg-white border border-gray-200 rounded-2xl p-3">
                </div>

            </div>


            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t">

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 rounded-2xl hover:bg-gray-200 transition font-semibold">
                    ← {{ __('messages.back') }}
                </a>

                <button type="submit"
                        id="submitBtn"
                        class="flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                    <span id="submitText">💾 {{ __('messages.save_product') }}</span>
                    <span id="submitLoader" class="hidden">
                        ⏳ {{ __('messages.saving') ?? 'Saving...' }}
                    </span>
                </button>

            </div>

        </form>

    </div>

</div>


<script>
document.getElementById('productForm').addEventListener('submit', function () {
    const btn = document.getElementById('submitBtn');
    const text = document.getElementById('submitText');
    const loader = document.getElementById('submitLoader');

    btn.disabled = true;
    btn.classList.add('opacity-70', 'cursor-not-allowed');

    text.classList.add('hidden');
    loader.classList.remove('hidden');
});
</script>
@endsection
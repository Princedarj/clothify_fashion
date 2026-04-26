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
                    {{ __('messages.products_management') ?? 'Products Management' }}
                </h2>

                <p class="text-slate-300 mt-2">
                    Total Products: {{ $products->total() }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <a href="{{ route('admin.products.create') }}"
                   class="bg-white text-indigo-700 px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-50 transition font-bold flex items-center gap-2">
                    <span class="text-xl">+</span>
                    <span>{{ __('messages.add_product') }}</span>
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
                            English
                        </a>

                        <a href="{{ route('lang.switch', 'hi') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            हिंदी
                        </a>

                        <a href="{{ route('lang.switch', 'gu') }}"
                           class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            ગુજરાતી
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

        <!-- Search + Filter -->
        <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Search product or category..."
                   class="xl:col-span-2 border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

            <select name="category"
                    class="border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">

                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->{'name_' . app()->getLocale()} ?? $category->name_en }}
                    </option>
                @endforeach

            </select>

            <a href="{{ route('admin.products.index') }}"
               class="flex items-center justify-center bg-slate-900 text-white px-5 py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition font-semibold">
                Reset
            </a>

        </form>

        <!-- Table Wrapper -->
        <div id="productTableWrapper" class="rounded-2xl overflow-hidden">
            @include('admin.products.partials.table')
        </div>

    </div>

</div>


<script>
    function toggleLangDropdown() {
        document.getElementById('langDropdown').classList.toggle('hidden');
    }

    const filterForm = document.getElementById('filterForm');

    if (filterForm) {
        const searchInput = filterForm.querySelector('input[name="search"]');
        const categorySelect = filterForm.querySelector('select[name="category"]');

        let typingTimer;

        searchInput.addEventListener('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                fetchProducts();
            }, 400);
        });

        categorySelect.addEventListener('change', function () {
            fetchProducts();
        });

        function fetchProducts(pageUrl = null) {
            const formData = new FormData(filterForm);
            const params = new URLSearchParams(formData).toString();

            let url = pageUrl ?? "{{ route('admin.products.index') }}?" + params;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('productTableWrapper').innerHTML = data;

                    if (!pageUrl) {
                        window.history.pushState({}, '', "{{ route('admin.products.index') }}?" + params);
                    } else {
                        window.history.pushState({}, '', pageUrl);
                    }
                })
                .catch(error => console.log(error));
        }

        document.addEventListener('click', function (e) {
            const link = e.target.closest('.ajax-pagination a');

            if (link) {
                e.preventDefault();
                fetchProducts(link.getAttribute('href'));
            }
        });
    }
</script>

@endsection
@extends('layouts.admin')

@section('content')

    <div class="bg-white p-6 rounded-xl shadow-sm">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    {{ __('messages.products_management') ?? 'Products Management' }}
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total Products: {{ $products->total() }}
                </p>
            </div>

            <div class="flex items-center gap-3">

                <a href="{{ route('admin.products.create') }}" class="px-5 py-2 rounded-lg text-white font-medium shadow-md 
                          bg-gradient-to-r from-indigo-500 to-purple-600 
                          hover:from-indigo-600 hover:to-purple-700 
                          transition duration-200 flex items-center gap-2">
                    <span class="text-lg">+</span>
                    <span>{{ __('messages.add_product') }}</span>
                </a>

                <!-- Language -->
                <div class="relative flex items-center">
                    <button onclick="toggleLangDropdown()"
                        class="bg-gray-100 px-4 py-2 flex items-center rounded-lg shadow hover:bg-gray-200">
                        <span class="flex items-center gap-2 leading-none">
                            <span>🌐</span>
                            <span>{{ __('messages.language') }}</span>
                        </span>
                    </button>

                    <div id="langDropdown" class="hidden absolute right-0 mt-2 bg-white shadow-lg rounded-lg w-32 z-50">
                        <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100">English</a>
                        <a href="{{ route('lang.switch', 'hi') }}" class="block px-4 py-2 hover:bg-gray-100">हिंदी</a>
                        <a href="{{ route('lang.switch', 'gu') }}" class="block px-4 py-2 hover:bg-gray-100">ગુજરાતી</a>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 flex items-center rounded-lg hover:bg-red-600 leading-none">
                        {{ __('messages.logout') }}
                    </button>
                </form>

            </div>
        </div>

        <!-- Search + Filter -->
        <form id="filterForm" class="flex flex-wrap gap-3 mb-5">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product or category..."
                class="border px-3 py-2 rounded-lg w-72">

            <select name="category" class="border px-3 py-2 rounded-lg w-56">
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->{'name_' . app()->getLocale()} ?? $category->name_en }}
                    </option>
                @endforeach
            </select>

            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
                Reset
            </a>

        </form>

        <!-- Table Wrapper -->
        <div id="productTableWrapper">
            @include('admin.products.partials.table')
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

                        // update browser URL without reload
                        if (!pageUrl) {
                            window.history.pushState({}, '', "{{ route('admin.products.index') }}?" + params);
                        } else {
                            window.history.pushState({}, '', pageUrl);
                        }
                    })
                    .catch(error => console.log(error));
            }

            // AJAX pagination
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
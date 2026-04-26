@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="relative rounded-3xl bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 p-8 shadow-2xl overflow-visible">
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
            <div>
                <p class="text-indigo-200 text-sm font-semibold uppercase tracking-widest mb-2">
                    {{ __('messages.Admin Panel') }}
                </p>

                <h2 class="text-4xl font-extrabold text-white flex items-center gap-3">
                    👥 {{ __('messages.users_management') }}
                </h2>

                <p class="text-slate-300 mt-2">
                    Manage registered customers and search users instantly
                </p>

                <p class="text-slate-300 mt-2">
                    Total Users: {{ $totalUsers }}
                </p>

            </div>

            <div class="flex items-center gap-3">

                <!-- Language -->
                <div class="relative">
                    <button onclick="toggleLangDropdown()"
                        class="bg-white/15 backdrop-blur-md border border-white/20 text-white px-5 py-3 rounded-2xl shadow-lg flex items-center gap-2 hover:bg-white/25 transition">
                        🌐 {{ __('messages.language') }}
                    </button>

                    <div id="langDropdown"
                        class="hidden absolute right-0 mt-3 bg-white shadow-2xl rounded-2xl w-40 z-[999] border overflow-hidden">

                        <a href="{{ route('lang.switch', 'en') }}" class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            English
                        </a>

                        <a href="{{ route('lang.switch', 'hi') }}" class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
                            हिंदी
                        </a>

                        <a href="{{ route('lang.switch', 'gu') }}" class="block px-5 py-3 hover:bg-indigo-50 text-gray-700">
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

    <!-- Search Card -->
    <div class="bg-white rounded-3xl shadow-xl border p-8">

        <form id="userSearchForm" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

        <!-- Search Type -->
        <select name="search_type"
            class="border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl">

            <option value="">Search By</option>

            <option value="id" {{ request('search_type') == 'id' ? 'selected' : '' }}>
                User ID
            </option>

            <option value="name" {{ request('search_type') == 'name' ? 'selected' : '' }}>
                Name
            </option>

            <option value="email" {{ request('search_type') == 'email' ? 'selected' : '' }}>
                Email
            </option>

            <option value="phone" {{ request('search_type') == 'phone' ? 'selected' : '' }}>
                Phone
            </option>

            <option value="city" {{ request('search_type') == 'city' ? 'selected' : '' }}>
                City
            </option>

        </select>


        <!-- Search Input -->
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Enter search value..."
            class="md:col-span-2 border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl">


        <!-- Order Filter -->
        <select name="min_orders"
            class="border border-gray-200 bg-gray-50 px-5 py-3 rounded-2xl">

            <option value="">All Order Count</option>

            <option value="1">1+ Orders</option>
            <option value="5">5+ Orders</option>
            <option value="10">10+ Orders</option>
            <option value="20">20+ Orders</option>

        </select>

    </form>

        <div id="usersTableWrapper">
            @include('admin.users.partials.table')
        </div>

    </div>

</div>


<script>
function toggleLangDropdown() {
    document.getElementById('langDropdown').classList.toggle('hidden');
}

const userSearchForm = document.getElementById('userSearchForm');

if (userSearchForm) {
    const searchInput = userSearchForm.querySelector('input[name="search"]');
    const minOrdersSelect = userSearchForm.querySelector('select[name="min_orders"]');

    let typingTimer;

    searchInput.addEventListener('keyup', function () {
        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {
            fetchUsers();
        }, 350);
    });

    minOrdersSelect.addEventListener('change', function () {
        fetchUsers();
    });

    function fetchUsers(pageUrl = null) {
        const formData = new FormData(userSearchForm);
        const params = new URLSearchParams(formData).toString();

        let url = pageUrl ?? "{{ route('admin.users.index') }}?" + params;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('usersTableWrapper').innerHTML = data;

            if (!pageUrl) {
                window.history.pushState({}, '', "{{ route('admin.users.index') }}?" + params);
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
            fetchUsers(link.getAttribute('href'));
        }
    });

    const searchType = userSearchForm.querySelector('select[name="search_type"]');

    searchType.addEventListener('change', function () {
        fetchUsers();
    });
}
</script>

@endsection
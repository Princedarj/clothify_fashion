<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="preload" as="image" href="{{ asset('uploads/Image/Background.jpg') }}">
    <meta charset="UTF-8">
    <title>{{ __('messages.User Panel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @include('layouts.user-navbar')

    @if(session('success'))
        <div id="successToast"
            class="fixed top-24 right-6 bg-green-600 text-white px-6 py-4 rounded-2xl shadow-xl z-50">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('successToast');
                if (toast) toast.remove();
            }, 3000);
        </script>
    @endif

    <main>
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        function applyTheme() {
            const theme = localStorage.getItem('theme');
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');

            if (theme === 'dark') {
                html.classList.add('dark');
                if (icon) icon.innerText = '☀️';
            } else {
                html.classList.remove('dark');
                if (icon) icon.innerText = '🌙';
            }
        }

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('themeIcon');

            html.classList.toggle('dark');

            if (html.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                if (icon) icon.innerText = '☀️';
            } else {
                localStorage.setItem('theme', 'light');
                if (icon) icon.innerText = '🌙';
            }
        }

        document.addEventListener('DOMContentLoaded', applyTheme);
    </script>
</body>

</html>
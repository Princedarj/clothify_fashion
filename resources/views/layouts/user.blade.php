<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>{{ __('messages.User Panel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('layouts.user-navbar')

    <main class="py-8">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>User Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    @include('layouts.user-navbar')

    <main class="py-8">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

</body>
</html>
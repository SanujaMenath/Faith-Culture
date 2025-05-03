<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Faith Culture')</title>

    @vite('resources/css/app.css') <!-- Tailwind setup -->
    @vite('resources/js/app.js')

</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900">

    <x-header />

    <main class="flex-grow">
        @yield('content')
    </main>

    <x-footer />
</body>
</html>

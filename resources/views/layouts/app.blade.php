<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Faith Culture')</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    @vite('resources/css/app.css') <!-- Tailwind setup -->
    @vite('resources/js/app.js')

</head>
<body class="min-h-screen flex flex-col bg-white text-gray-900">

    <x-header />

    <main class="flex-grow">
        @yield('content')
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

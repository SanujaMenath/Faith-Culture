<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Faith Culture')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind setup -->
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <style>
        input[type='number']::-webkit-outer-spin-button,
        input[type='number']::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type='number'] {
            -moz-appearance: textfield;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col bg-white text-gray-900">

    <x-header />

    <div class="min-h-screen flex">
        <x-adminSideBar />

        <main class="grow">
            @yield('content')
        </main>
    </div>


    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
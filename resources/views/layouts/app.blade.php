<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Faith Culture')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        input[type='number']::-webkit-outer-spin-button,
        input[type='number']::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type='number'] {
            -moz-appearance: textfield;
        }
    </style>

    @vite('resources/css/app.css') <!-- Tailwind setup -->
    @vite('resources/js/app.js')
</head>

<body class="min-h-screen flex flex-col bg-white text-gray-900" x-data="{ showSearch: false }">

    <x-header />

    <main class="grow">
        @yield('content')
    </main>
 
        <!-- Search Modal Overlay -->
        <div x-show="showSearch" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 bg-black/30 backdrop-blur-sm flex items-center justify-center px-4">

            <!-- Search Box -->
            <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-xl relative">
                <!-- Close Button -->
                <button @click="showSearch = false"
                    class="absolute top-1 right-2 text-gray-500 hover:text-black text-xl">
                    <i class="fa-solid fa-close"></i>
                </button>

                <!-- Search Form -->
                <form action="{{ route('search.page') }}" method="GET" class="flex flex-col items-center gap-4">
                    <input type="text" name="query"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-700"
                        placeholder="Search for products...">
                    <button type="submit"
                        class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-black transition-all">
                        Search
                    </button>
                </form>
            </div>
        </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>
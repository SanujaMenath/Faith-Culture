@extends('layouts.app')

@section('title', 'Shop Now! - Faith Culture')

@section('content')
    <div x-data="{ showSidebar: false }" class="max-w-7xl xl:max-w-[1440px] mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center justify-between">
            Shop
            <!-- Mobile Sidebar Toggle -->
            <button @click="showSidebar = !showSidebar" aria-label="Toggle Categories"
                class="lg:hidden p-2 rounded text-gray-600 hover:text-gray-800 focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </h1>

        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar -->
            <aside :class="showSidebar ? 'block' : 'hidden'"
                class="lg:block lg:w-60 w-full bg-white shadow rounded p-4 lg:sticky top-24 self-start z-10">
                <h2 class="text-lg font-semibold mb-4">Categories</h2>
                <ul class="space-y-2">
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('shop.category', $category->id) }}"
                                class="block px-2 py-1 rounded hover:bg-gray-100 text-gray-700">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </aside>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 flex-1 items-stretch">
                @foreach ($products as $product)
                    @php
                        $inventory = $product->inventories->first();
                    @endphp

                    <div class="flex flex-col justify-between p-4 shadow rounded h-full bg-white hover:shadow-lg transition">
                        <a href="{{ route('product.details', $product->id) }}" class="flex flex-col h-full">
                            <!-- Product Info -->
                            <div class="grow">
                                <h2 class="text-lg font-semibold truncate mb-1">{{ $product->name }}</h2>
                                <p class="text-gray-600 text-sm line-clamp-2 h-[3.5rem]">{{ $product->description }}</p>
                            </div>

                            <!-- Product Image -->
                            <div class="mt-2 aspect-[4/5] w-full overflow-hidden rounded">
                                @if ($inventory && $inventory->image_url)
                                    <img src="{{ asset('storage/' . $inventory->image_url) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                        No Image
                                    </div>
                                @endif
                            </div>


                            <!-- Price and Button -->
                            <div class="mt-3 flex items-center justify-between">
                                <p class="text-blue-600 font-bold text-lg">
                                    Rs. {{ $inventory ? number_format($inventory->price, 2) : 'N/A' }}
                                </p>
                                <button class="bg-gray-800 text-white px-4 py-2 text-sm rounded hover:bg-gray-600 transition">
                                    Add
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $products->links() }}
        </div>

    </div>
@endsection
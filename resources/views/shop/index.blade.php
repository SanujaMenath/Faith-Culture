@extends('layouts.app')

@section('title', 'Shop Now! - Faith Culture')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Shop</h1>

        <div class="flex gap-6">
            <!-- Sidebar -->
            <aside class="w-60 bg-white shadow rounded p-4">
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

            <!-- Main Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 flex-1">
                @foreach ($products as $product)
                    <div class="p-4 shadow rounded h-full max-w-sm min-w-3xs mx-auto flex flex-col">
                        <div class="grow">
                            <h2 class="text-xl font-semibold truncate">{{ $product->name }}</h2>
                            <p class="text-gray-600 h-12 overflow-hidden">{{ $product->description }}</p>
                        </div>
                        <div class="mt-2 h-72 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover rounded">

                        </div>
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-blue-600 font-bold text-lg">Rs. {{ $product->price }}</p>
                            <a href="{{ route('cart.add', $product->id) }}" class="bg-gray-800 text-white px-4 py-2 text-sm rounded hover:bg-gray-600 transition">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
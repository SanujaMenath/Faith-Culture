@extends('layouts.app')

@section('title', 'Search Results - Faith Culture')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Search Results for "{{ $query }}"
        </h1>

        @forelse ($products as $product)
            <div class="bg-white shadow rounded hover:shadow-lg transition duration-300 mb-8">
                <div class="p-4 border-b">
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm mt-2">{{ $product->description }}</p>
                </div>

                <!-- Product Variants Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
                    @foreach ($product->inventories as $variant)
                        <div class="border rounded hover:border-gray-400 transition duration-300 h-full flex flex-col">
                            <a href="{{ route('product.details',$product->id) }}" class="h-full flex flex-col">
                                <!-- 4:3 Aspect Ratio Image Container -->
                                <div class="relative w-full overflow-hidden" style="padding-top: 75%">
                                    @if ($variant->image_url)
                                        <img src="{{ asset('storage/' . $variant->image_url) }}" alt="{{ $product->name }} - {{ $variant->color->name }}"
                                            class="absolute top-0 left-0 w-full h-full object-cover">
                                    @else
                                        <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center bg-gray-100 text-gray-400">
                                            No Image
                                        </div>
                                    @endif
                                </div>

                                <!-- Variant Info -->
                                <div class="p-3 flex flex-col flex-grow">
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-gray-700">Color:</span>
                                            <span class="font-medium">{{ $variant->color->name }}</span>
                                        </div>
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-gray-700">Size:</span>
                                            <span class="font-medium">{{ $variant->size->name }}</span>
                                        </div>
                                    </div>

                                    <div class="mt-2 pt-2 border-t flex items-center justify-between">
                                        <p class="text-blue-600 font-bold">
                                            Rs. {{ number_format($variant->price, 2) }}
                                        </p>

                                        <button class="bg-gray-800 text-white px-4 py-2 text-sm rounded hover:bg-gray-600 transition">
                                            Add
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white shadow rounded p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-700 mb-2">No Products Found</h2>
                <p class="text-gray-500">We couldn't find any products matching "{{ $query }}"</p>
                <a href="{{ route('shop') }}" class="inline-block mt-6 bg-gray-800 text-white px-6 py-2 rounded hover:bg-gray-700 transition">
                    Return to Shop
                </a>
            </div>
        @endforelse

        <!-- Pagination -->
        @if(isset($products) && method_exists($products, 'hasPages') && $products->hasPages())
        <div class="mt-8">
            {{ $products->appends(['query' => $query])->links() }}
        </div>
        @endif
    </div>
@endsection
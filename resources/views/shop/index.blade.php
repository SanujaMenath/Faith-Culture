@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Shop</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="p-4 shadow rounded">
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p class="text-blue-600 font-bold">${{ $product->price }}</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="mt-2 w-full h-auto">
                </div>
            @endforeach

        </div>
    </div>
@endsection
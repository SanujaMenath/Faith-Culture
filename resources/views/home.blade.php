@extends('layouts.app')

@section('title', 'Welcome to Clothing Store')

@section('content')
    <section class="bg-gray-50 py-20 text-center">
        <h1 class="text-4xl font-bold mb-4">Discover the Latest Fashion</h1>
        <p class="text-lg text-gray-600">Trendy. Affordable. Comfortable.</p>
        <a href="/shop" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Shop Now
        </a>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Welcome to Faith Culture')

@section('content')
    <!-- Hero Section with Background Image -->
    <section class="relative bg-cover bg-no-repeat bg-center py-20 h-screen " style="background-image: url('{{ asset('storage/images/home1.jpg') }}')">
        <!-- Semi-transparent overlay for text readability -->
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <!-- Content with elevated text -->
        <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
            <!-- Text container with semi-transparent background -->
            <div class="bg-gray backdrop-blur-xs py-8 px-10 rounded-lg shadow-lg">
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Discover the Latest Fashion</h1>
                <p class="text-xl text-white">Trendy. Affordable. Comfortable.</p>
                <a href="/shop" class="mt-6 inline-block bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105 shadow-md">
                    Shop Now
                </a>
            </div>
        </div>
    </section>
@endsection
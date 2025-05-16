@extends('layouts.app')

@section('title', 'Welcome to Faith Culture')

@section('content')
    <!-- Hero Section with Image Carousel -->
    <section class="relative h-screen">
        <!-- Carousel Container -->
        <div id="heroCarousel" class="carousel relative w-full h-full">
            <!-- Carousel Item 1 -->
            <div class="carousel-item absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-100 z-10">
                <img src="{{ asset('storage/images/home1.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
                <!-- Semi-transparent overlay -->
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>

            <!-- Carousel Item 2 -->
            <div class="carousel-item absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0 z-0">
                <img src="{{ asset('storage/images/home2.jpg') }}" alt="Slide 2" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>

            <!-- Carousel Item 3 -->
            <div class="carousel-item absolute inset-0 w-full h-full transition-opacity duration-1000 opacity-0 z-0">
                <img src="{{ asset('storage/images/home3.jpg') }}" alt="Slide 3" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>


            <!-- Content with elevated text (shown on all slides) -->
            <div class="relative z-10 container mx-auto px-4 h-full flex flex-col items-center justify-center text-center">
                <div class=" bg-opacity-50 backdrop-blur-sm py-8 px-10 rounded-lg shadow-lg transform translate-y-40">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Discover the Latest Fashion</h1>
                    <p class="text-xl text-white">Trendy. Affordable. Comfortable.</p>
                    <a href="/shop"
                        class="mt-6 inline-block bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105 shadow-md">
                        Shop Now
                    </a>
                </div>
            </div>

            <!-- Previous/Next Arrow Buttons -->
            <button
                class="carousel-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 text-white p-2 rounded-lg hover:bg-opacity-50 transition z-20">
                <i class="fa-solid fa-angle-left fa-2x"></i>
            </button>
            <button
                class="carousel-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 text-white p-2 rounded-lg hover:bg-opacity-50 transition z-20">
                <i class="fa-solid fa-angle-right fa-2x"></i>
            </button>

            <!-- Carousel Indicators -->
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2 z-20">
                <button
                    class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"
                    data-slide="0"></button>
                <button
                    class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"
                    data-slide="1"></button>
                <button
                    class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition"
                    data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- Shop the Look Section -->
    <section class="py-12 mb-4 bg-white relative z-10">
        <div class="container max-w-4xl mx-auto px-4 relative z-10">
            <!-- Header -->
            <div class="flex justify-end items-center mb-8 md:mr-4 gap-8 z-20 relative">
                <h2 class="text-2xl font-bold">SHOP THE LOOK</h2>
                <div class="flex gap-4">
                    <button
                        class="w-10 h-10 flex items-center justify-center border rounded-full hover:bg-gray-100 transition">
                        <span><i class="fa-solid fa-arrow-left fa-2x"></i></span>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center border rounded-full hover:bg-gray-100 transition">
                        <span><i class="fa-solid fa-arrow-right fa-2x"></i></span>
                    </button>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="flex flex-col justify-center md:flex-row gap-4 md:gap-16 relative z-10">
                <!-- Left (Model Image) -->
                <div class="flex sm:h-[480px] sm:w-[380px] overflow-hidden rounded-lg mx-auto md:mx-0">
                    <img src="{{ asset('storage/images/home2.jpg') }}" alt="Model"
                        class="w-full h-full object-cover rounded-lg">
                </div>

                <!-- Right (Product Images) -->
                <div class="flex flex-row gap-2 md:gap-6 ">
                    <!-- Top -->
                    <div class="flex items-center justify-center lg:justify-end flex-1">
                        <div class="w-[180px] h-auto">
                            <img src="{{ asset('storage/products/1746609735.jpg') }}" alt="Top"
                                class="w-full h-auto object-cover rounded-lg shadow">
                        </div>
                    </div>

                    <!-- Trouser -->
                    <div class="flex items-center justify-center lg:justify-start flex-1">
                        <div class="w-[180px] h-auto">
                            <img src="{{ asset('storage/products/pant.jpg') }}" alt="Trouser"
                                class="w-full h-auto object-cover rounded-lg shadow">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Section Heading -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">New Arrivals</h2>
                <a href="{{ route('shop') }}" class="text-gray-600 hover:text-gray-800 transition font-medium">View All
                    &rarr;</a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 md:mx-4 gap-2 md:gap-6">
                @foreach ($newArrivals as $inventory)
                    @php $product = $inventory->product @endphp
                    
                    <div class="bg-white shadow rounded-lg overflow-hidden group hover:shadow-lg transition">
                        <!-- Product Image -->
                        <a href="{{ route('product.details', $product->id) }}">
                            <img src="{{ asset('storage/' . $inventory->image_url) }}" alt="{{ $product->name }}"
                                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                        

                        <!-- Product Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 truncate"> {{ $product->name }} </h3>
                            <p class="text-gray-600 mt-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            <div class="mt-2 text-lg font-bold text-gray-900">Rs. {{ number_format($inventory->price, 2) }}</div>
                        </div>
                        </a>
                    </div>
                @endforeach
            </div>

            @if ($newArrivals->isEmpty())
                <p class="text-gray-500 text-center mt-8">No new arrivals at the moment. Please check back later!</p>
            @endif
        </div>
    </section>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('heroCarousel');
            const items = carousel.querySelectorAll('.carousel-item');
            const indicators = carousel.querySelectorAll('.carousel-indicator');
            const prevBtn = carousel.querySelector('.carousel-prev');
            const nextBtn = carousel.querySelector('.carousel-next');

            let currentSlide = 0;
            let slideInterval = setInterval(nextSlide, 5000);

            // Set the initial indicator as active
            indicators[0].classList.add('bg-opacity-100');

            // Function to show a specific slide
            function showSlide(index) {
                // Hide all slides
                items.forEach(item => {
                    item.classList.remove('opacity-100', 'z-10');
                    item.classList.add('opacity-0', 'z-0');
                });

                // Show the selected slide
                items[index].classList.remove('opacity-0', 'z-0');
                items[index].classList.add('opacity-100', 'z-10');

                // Update indicators
                indicators.forEach(indicator => {
                    indicator.classList.remove('bg-opacity-100');
                    indicator.classList.add('bg-opacity-50');
                });

                indicators[index].classList.remove('bg-opacity-50');
                indicators[index].classList.add('bg-opacity-100');

                currentSlide = index;

                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            }



            // Function to show the next slide
            function nextSlide() {
                let nextIndex = currentSlide + 1;
                if (nextIndex >= items.length) {
                    nextIndex = 0;
                }
                showSlide(nextIndex);
            }

            // Function to show the previous slide
            function prevSlide() {
                let prevIndex = currentSlide - 1;
                if (prevIndex < 0) {
                    prevIndex = items.length - 1;
                }
                showSlide(prevIndex);
            }

            // Event listeners for buttons
            nextBtn.addEventListener('click', function () {
                nextSlide();
            });

            prevBtn.addEventListener('click', function () {
                prevSlide();
            });

            // Event listeners for indicators
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', function () {
                    showSlide(index);
                });
            });

            // Pause slider on hover
            carousel.addEventListener('mouseenter', function () {
                clearInterval(slideInterval);
            });

            // Resume slider on mouse leave
            carousel.addEventListener('mouseleave', function () {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000);
            });
        });
    </script>
@endsection
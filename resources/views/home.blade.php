@extends('layouts.app')

@section('title', 'Welcome to Faith Culture')

@section('content')
    <!-- Hero Section with Background Image Carousel -->
    <section class="relative h-screen">
        <!-- Carousel Container -->
        <div id="heroCarousel" class="carousel relative w-full h-full">
            <!-- Carousel Item 1 -->
            <div class="carousel-item absolute inset-0 bg-cover bg-no-repeat bg-center transition-opacity duration-1000 opacity-100" 
                style="background-image: url('{{ asset('storage/images/home1.jpg') }}')">
                <!-- Semi-transparent overlay -->
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            
            <!-- Carousel Item 2 -->
            <div class="carousel-item absolute inset-0 bg-cover bg-no-repeat bg-center transition-opacity duration-1000 opacity-0" 
                style="background-image: url('{{ asset('storage/images/home2.jpg') }}')">
                <!-- Semi-transparent overlay -->
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            
            <!-- Carousel Item 3 -->
            <div class="carousel-item absolute inset-0 bg-cover bg-no-repeat bg-center transition-opacity duration-1000 opacity-0" 
                style="background-image: url('{{ asset('storage/images/home3.jpg') }}')">
                <!-- Semi-transparent overlay -->
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            
            <!-- Content with elevated text (shown on all slides) -->
            <div class="relative z-10 container mx-auto px-4 pt-96 h-full flex flex-col items-center text-center">
                <div class=" bg-opacity-50 backdrop-blur-sm py-8 px-10 rounded-lg shadow-lg">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Discover the Latest Fashion</h1>
                    <p class="text-xl text-white">Trendy. Affordable. Comfortable.</p>
                    <a href="/shop" class="mt-6 inline-block bg-gray-500 text-white px-8 py-3 rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105 shadow-md">
                        Shop Now
                    </a>
                </div>
            </div>
            
            <!-- Previous/Next Arrow Buttons -->
            <button class="carousel-prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 text-white p-2 rounded-full hover:bg-opacity-50 transition z-20">
                <i class="fa-solid fa-angle-left fa-2x"></i>
            </button>
            <button class="carousel-next absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-30 text-white p-2 rounded-full hover:bg-opacity-50 transition z-20">
                 <i class="fa-solid fa-angle-right fa-2x"></i>
            </button>
            
            <!-- Carousel Indicators -->
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-2 z-20">
                <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition" data-slide="0"></button>
                <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition" data-slide="1"></button>
                <button class="carousel-indicator w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100 transition" data-slide="2"></button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                item.classList.remove('opacity-100');
                item.classList.add('opacity-0');
            });
            
            // Show the selected slide
            items[index].classList.remove('opacity-0');
            items[index].classList.add('opacity-100');
            
            // Update indicators
            indicators.forEach(indicator => {
                indicator.classList.remove('bg-opacity-100');
                indicator.classList.add('bg-opacity-50');
            });
            
            indicators[index].classList.remove('bg-opacity-50');
            indicators[index].classList.add('bg-opacity-100');
            
            // Update current slide index
            currentSlide = index;
            
            // Reset the timer
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
        nextBtn.addEventListener('click', function() {
            nextSlide();
        });
        
        prevBtn.addEventListener('click', function() {
            prevSlide();
        });
        
        // Event listeners for indicators
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                showSlide(index);
            });
        });
        
        // Pause slider on hover
        carousel.addEventListener('mouseenter', function() {
            clearInterval(slideInterval);
        });
        
        // Resume slider on mouse leave
        carousel.addEventListener('mouseleave', function() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000);
        });
    });
</script>
@endpush
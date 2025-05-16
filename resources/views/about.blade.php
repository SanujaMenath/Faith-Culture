@extends('layouts.app')

@section('title', 'About Us - Faith Culture')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12 space-y-16">

    <!-- Hero Section -->
    <section class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">About Faith Culture</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Faith Culture is more than just a clothing brand – it's a movement of style, faith, and community. We blend modern trends with timeless values, creating fashion that reflects identity and purpose.
        </p>
    </section>

    <!-- Our Mission -->
    <section class="grid grid-cols-1  md:grid-cols-2 gap-8 items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-3">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed">
                At Faith Culture, our mission is to inspire individuals to wear their values with pride. We aim to empower local communities through ethical sourcing, inclusive sizing, and uplifting design that speaks hope and strength.
            </p>
        </div>
        <div class="flex justify-center">
            <img src="storage/images/logo.jpg" alt="Our Mission" class="rounded-lg shadow-md w-md object-cover">
        </div>
    </section>

    <!-- Contact Info & Location -->
    <section class="bg-gray-100 p-6 rounded-lg shadow-inner">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Get In Touch</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-700"><strong>Address:</strong><br>
                    123 Culture Street,<br>
                    Colombo 07, Sri Lanka
                </p>
                <p class="text-gray-700 mt-4"><strong>Email:</strong> contact@faithculture.lk</p>
                <p class="text-gray-700"><strong>Phone:</strong> +94 71 234 5678</p>
            </div>
            <div>
                <iframe class="rounded w-full h-64 border"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63317.87905859772!2d79.8587354!3d6.9270789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2595eab8e02f7%3A0x6d4db7f6b79fdc47!2sColombo!5e0!3m2!1sen!2slk!4v1685621311683!5m2!1sen!2slk"
                    allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Social Welfare Initiatives -->
    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Our Social Responsibility</h2>
        <p class="text-gray-600 mb-6">
            Faith Culture believes in giving back. From supporting women-led tailoring cooperatives to donating clothing to disaster-affected communities, our commitment goes beyond fashion.
        </p>

        <!-- Placeholder to display upcoming social initiatives -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example Card -->
            <div class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Flood Relief 2024</h3>
                <p class="text-gray-600 text-sm">
                    Donated over 500 clothing packs and partnered with local NGOs to provide essentials to families in need.
                </p>
            </div>
            <!-- Placeholder for future updates -->
            <div class="bg-white shadow rounded p-4 flex items-center justify-center text-gray-400 italic">
                Add your next social story here...
            </div>
            <div class="bg-white shadow rounded p-4 flex items-center justify-center text-gray-400 italic">
                Highlight your team’s impact...
            </div>
        </div>
    </section>

</div>
@endsection

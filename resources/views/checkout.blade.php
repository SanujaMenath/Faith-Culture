@extends('layouts.app')
@section('title', 'Checkout - Faith Culture')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    <form action="{{ route('order.place') }}" method="POST"
        class="space-y-6 max-w-3xl mx-auto bg-white p-6 rounded shadow">
        @csrf

         <!-- Delivery Fields -->
        <h2 class="text-2xl font-bold mb-4">Delivery Information</h2>
       
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="full_name" class="block font-semibold">Full Name</label>
                <input type="text" id="full_name" name="full_name" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

            <div>
                <label for="email" class="block font-semibold">Email Address</label>
                <input type="email" id="email" name="email" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

            <div>
                <label for="phone" class="block font-semibold">Telephone Number</label>
                <input type="tel" id="phone" name="phone" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>

            <div>
                <label for="city" class="block font-semibold">City / District</label>
                <input type="text" id="city" name="city" required
                    class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <div>
            <label for="address" class="block font-semibold">Delivery Address</label>
            <textarea id="address" name="address" required rows="3"
                class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"></textarea>
        </div>

        <div>
            <label for="postal_code" class="block font-semibold">Postal Code (optional)</label>
            <input type="text" id="postal_code" name="postal_code"
                class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <!-- Payment Method Selection -->
        <div>
            <label class="block font-semibold mb-2">Payment Method</label>
            <div class="space-y-2">
                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="cod" required class="form-radio text-black mr-2">
                    <span>Cash on Delivery</span>
                </label>

                <label class="flex items-center">
                    <input type="radio" name="payment_method" value="card" required class="form-radio text-black mr-2">
                    <span>Card Payment (Visa/Master)</span>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit"
                class="w-full bg-black text-white py-3 rounded font-semibold hover:bg-gray-800 transition">
                Place Order
            </button>
        </div>
    </form>

    @endsection
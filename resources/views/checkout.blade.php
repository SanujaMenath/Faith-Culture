@extends('layouts.app')
@section('title', 'Checkout - Faith Culture')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Checkout</h1>

    @if($cartItems->isEmpty())
        <div class="text-center text-gray-600">No items to checkout.</div>
    @else
    <form action="{{ route('order.place') }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf

        <!-- Order Summary -->
        <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
        <div class="space-y-4">
            @php $subtotal = 0; @endphp
            @foreach($cartItems as $item)
                @php
                    $product = $item['product'];
                    $itemTotal = $product->price * $item['quantity'];
                    $subtotal += $itemTotal;
                @endphp
                <div class="flex justify-between items-center border-b pb-2">
                    <div>
                        <div class="font-semibold">{{ $product->name }}</div>
                        <div class="text-sm text-gray-600">
                            Color: {{ $item['color'] ?? 'N/A' }} | Size: {{ $item['size'] ?? 'N/A' }}
                        </div>
                        <div class="text-sm">Quantity: {{ $item['quantity'] }}</div>
                    </div>
                    <div class="font-semibold">Rs. {{ number_format($itemTotal, 2) }}</div>
                </div>
            @endforeach
        </div>

        <!-- Delivery Info -->
        <h2 class="text-2xl font-bold mt-6 mb-4">Delivery Information</h2>
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

        <!-- Payment Method -->
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

        <!-- Order Total -->
        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
            <h3 class="font-semibold text-lg mb-3">Order Total</h3>
            @php
                $deliveryFee = $subtotal >= 20000 ? 0 : 500;
                $total = $subtotal + $deliveryFee;
            @endphp
            <div class="flex justify-between mb-1">
                <span>Subtotal:</span>
                <span>Rs. {{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="flex justify-between mb-1">
                <span>Delivery Fee:</span>
                <span>Rs. {{ number_format($deliveryFee, 2) }}</span>
            </div>
            <div class="flex justify-between font-bold text-lg">
                <span>Total:</span>
                <span>Rs. {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <!-- Special Instructions -->
        <div>
            <label for="special_instructions" class="block font-semibold">Special Instructions (optional)</label>
            <textarea id="special_instructions" name="special_instructions" rows="2"
                class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                placeholder="Any special instructions for delivery"></textarea>
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <input type="checkbox" id="terms" name="terms" required class="mt-1 mr-2">
            <label for="terms" class="text-sm">
                I agree to the <a href="#" class="text-black underline">Terms and Conditions</a> and
                <a href="#" class="text-black underline">Privacy Policy</a>.
            </label>
        </div>

        <!-- Submit -->
        <div class="pt-6">
            <button type="submit"
                class="w-full bg-black text-white py-3 rounded font-semibold hover:bg-gray-800 transition">
                Place Order &nbsp; <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </form>
    @endif
</div>
@endsection

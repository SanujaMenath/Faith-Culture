@extends('layouts.app')
@section('title', 'Checkout - Faith Culture')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Checkout</h1>

        @if($cartItems->isEmpty())
            <div class="text-center text-gray-600">No items to checkout.</div>
        @else
            <form action="{{ route('order.place') }}" method="POST" class="bg-white rounded-xl border-y-2 shadow-2xl">
                @csrf
                
                <div class="flex flex-col md:flex-row ">
                    <!-- Left Column: Delivery Information -->
                    <div class="w-full md:w-3/5 p-6 border-r">
                        <h2 class="text-2xl font-bold mb-6">Delivery Information</h2>
                        
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

                        <div class="mt-4">
                            <label for="address" class="block font-semibold">Delivery Address</label>
                            <textarea id="address" name="address" required rows="3"
                                class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"></textarea>
                        </div>

                        <div class="mt-4">
                            <label for="postal_code" class="block font-semibold">Postal Code (optional)</label>
                            <input type="text" id="postal_code" name="postal_code"
                                class="w-full mt-1 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                        </div>
                        
                        <!-- Payment Method -->
                        <div class="mt-6">
                            <label class="block font-semibold mb-2">Payment Method</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment_method" value="cod" required class="form-radio text-black mr-3">
                                    <div>
                                        <span class="font-medium">Cash on Delivery</span>
                                        <p class="text-sm text-gray-500">Pay when your order arrives</p>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" required class="form-radio text-black mr-3">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <span class="font-medium">Card Payment</span>
                                            <div class="flex space-x-2">
                                                <div class="w-8 h-5 bg-blue-900 rounded"></div>
                                                <div class="w-8 h-5 bg-red-500 rounded"></div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500">Secure payment with Visa/Mastercard</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Special Instructions -->
                        <div class="mt-6">
                            <label for="special_instructions" class="block font-semibold">Special Instructions (optional)</label>
                            <textarea id="special_instructions" name="special_instructions" rows="2"
                                class="w-full mt-1 border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-black"
                                placeholder="Any special instructions for delivery"></textarea>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-6 flex items-start">
                            <input type="checkbox" id="terms" name="terms" required class="mt-1 mr-2">
                            <label for="terms" class="text-sm">
                                I agree to the <a href="#" class="text-black underline">Terms and Conditions</a> and
                                <a href="#" class="text-black underline">Privacy Policy</a>.
                            </label>
                        </div>
                    </div>
                    
                    <!-- Right Column: Order Summary -->
                    <div class="w-full md:w-2/5 p-6 bg-gray-50 shadow-lg rounded-xl ">
                        <h2 class="text-2xl font-bold mb-4">Order Summary</h2>
                        <div class="space-y-4 max-h-80 overflow-y-auto pr-2 mb-6">
                            @php $subtotal = 0; @endphp
                            @foreach($cartItems as $item)
                                @php
                                    $inventory = $item->inventory;
                                    $product = $inventory?->product;
                                    $color = $inventory?->color->name ?? 'N/A';
                                    $size = $inventory?->size->name ?? 'N/A';
                                    $price = $inventory?->price ?? 0;
                                    $itemTotal = $price * $item->quantity;
                                    $subtotal += $itemTotal;
                                @endphp
                                <div class="flex justify-between items-center border-b pb-4">
                                    <div class="flex items-start gap-3">
                                        @if($product && $inventory->image_url)
                                            <img src="{{ asset('storage/' . $inventory->image_url) }}" 
                                                alt="{{ $product->name }}" 
                                                class="w-16 h-20 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">No image</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold">{{ $product?->name ?? 'Product not found' }}</div>
                                            <div class="text-sm text-gray-600">
                                                Color: {{ $color }} | Size: {{ $size }}
                                            </div>
                                            <div class="text-sm">Quantity: {{ $item->quantity }}</div>
                                        </div>
                                    </div>
                                    <div class="font-semibold">Rs. {{ number_format($itemTotal, 2) }}</div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Delivery Options -->
                        <div class="mb-6">
                            <h3 class="font-semibold text-lg mb-3">Delivery Options</h3>
                            @php
                                $standardDelivery = 500;
                                $expressDelivery = 1000;
                                $freeThreshold = 20000;
                                $isFreeEligible = $subtotal >= $freeThreshold;
                            @endphp
                            
                            <div class="space-y-3">
                                <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-white transition" 
                                       onclick="updateDeliveryCharge('standard')">
                                    <input type="radio" name="delivery_option" value="standard" checked 
                                           class="form-radio mt-1 text-black mr-3">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <span class="font-medium">Standard Delivery</span>
                                            <span class="font-medium">Rs. {{ number_format($standardDelivery, 2) }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Delivery within 3-5 business days</p>
                                    </div>
                                </label>
                                
                                <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-white transition"
                                       onclick="updateDeliveryCharge('express')">
                                    <input type="radio" name="delivery_option" value="express" 
                                           class="form-radio mt-1 text-black mr-3">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <span class="font-medium">Express Delivery</span>
                                            <span class="font-medium">Rs. {{ number_format($expressDelivery, 2) }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Delivery within 1-2 business days</p>
                                    </div>
                                </label>
                                
                                @if($isFreeEligible)
                                <label class="flex items-start p-3 border rounded cursor-pointer hover:bg-white transition"
                                       onclick="updateDeliveryCharge('free')">
                                    <input type="radio" name="delivery_option" value="free" 
                                           class="form-radio mt-1 text-black mr-3">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <span class="font-medium">Free Delivery</span>
                                            <span class="font-medium">Rs. 0.00</span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1">Free delivery for orders over Rs. 20,000 (5-7 business days)</p>
                                    </div>
                                </label>
                                @endif
                            </div>
                        </div>

                        <!-- Order Total -->
                        <div class="bg-white p-4 rounded-lg border mb-6">
                            <h3 class="font-semibold text-lg mb-3">Order Total</h3>
                            @php
                                $defaultDeliveryFee = $isFreeEligible ? 0 : $standardDelivery;
                                $total = $subtotal + $defaultDeliveryFee;
                            @endphp
                            
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>Subtotal:</span>
                                    <span>Rs. {{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between" id="delivery-fee-row">
                                    <span>Delivery Fee:</span>
                                    <span id="delivery-fee">Rs. {{ number_format($defaultDeliveryFee, 2) }}</span>
                                </div>
                                <div class="border-t border-gray-200 my-2 pt-2"></div>
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total:</span>
                                    <span id="total-amount">Rs. {{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-black text-white py-3 rounded font-semibold hover:bg-gray-800 transition flex items-center justify-center">
                            <span>Place Order</span>
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        @endif
    </div>

    <script>
        function updateDeliveryCharge(option) {
            const subtotal = {{ $subtotal ?? 0 }};
            let deliveryFee = {{ $standardDelivery }};
            
            if (option === 'express') {
                deliveryFee = {{ $expressDelivery }};
            } else if (option === 'free') {
                deliveryFee = 0;
            }
            
            document.getElementById('delivery-fee').textContent = 'Rs. ' + deliveryFee.toFixed(2);
            document.getElementById('total-amount').textContent = 'Rs. ' + (subtotal + deliveryFee).toFixed(2);
        }
    </script>
@endsection
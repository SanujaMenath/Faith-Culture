@extends('layouts.app')

@section('title', 'My Cart - Faith Culture')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">My Cart</h2>
        <div class="flex items-center">
            <span class="text-lg">{{ Auth::check() ? $cartItems->count() : (session('cart') ? count(session('cart')) : 0) }}</span>
            <i class="fas fa-shopping-cart ml-1"></i>
        </div>
    </div>

    <form action="{{ route('checkout.index') }}" method="POST" id="checkoutForm">
        @csrf
        @if(Auth::check())
            <!-- If user is logged in, display cart from the database -->
            @if($cartItems->isNotEmpty())
                <div class="flex justify-end mb-4">
                    <button type="button" id="selectAllBtn" class="text-blue-600 hover:text-blue-800">Select All</button>
                </div>

                <div class="space-y-6">
                    @foreach ($cartItems as $item)
                        <div class="border-b pb-6">
                            <div class="flex justify-between items-start">
                                <div class="flex items-start space-x-4">
                                    <div class="pt-2">
                                        <input type="checkbox" name="selected_items[]" value="{{ $item->product_id }}" class="item-checkbox h-5 w-5">
                                    </div>
                                    <img src="{{ asset('storage/' . $item->product->image_url) }}" class="h-40 w-40 object-cover rounded" alt="{{ $item->product->name }}">
                                    <div>
                                        <h3 class="font-medium text-lg">{{ $item->product->name }}</h3>
                                        <p class="text-gray-500">{{ $item->variant ?? '' }}</p>
                                        <p class="font-bold mt-1">Rs {{ $item->product->price }}</p>
                                        
                                        <!-- Quantity controls moved here -->
                                        <div class="flex items-center mt-4">
                                            <div class="flex items-center border rounded">
                                                <button type="button" onclick="decrementQuantity({{ $item->product_id }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span class="px-4 py-1 item-quantity" data-product-id="{{ $item->product_id }}">{{ $item->quantity }}</span>
                                                <button type="button" onclick="incrementQuantity({{ $item->product_id }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="removeCartItem({{ $item->product_id }})" class="text-gray-600 hover:text-black">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Notes and checkout section -->
                <div class="mt-8 border rounded p-4">
                    <div class="flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        <input type="text" name="order_note" placeholder="Leave a note with your order" class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Total and checkout buttons -->
                <div class="mt-6">
                    <div class="flex justify-between items-center font-bold text-lg mb-6">
                        <span>Total</span>
                        <span class="cart-total">${{ $cartItems->sum(function($item) { return $item->product->price * $item->quantity; }) }}</span>
                    </div>
                    
                    <button type="submit" class="block w-full bg-black text-white text-center py-4 rounded-full font-medium hover:bg-gray-800 mb-3">
                        PROCEED TO CHECKOUT
                    </button>
                    
                    <a href="{{ route('shop') }}" class="block w-full bg-gray-100 text-black text-center py-4 rounded-full font-medium hover:bg-gray-200">
                        CONTINUE SHOPPING
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-xl mb-6">Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800">
                        START SHOPPING
                    </a>
                </div>
            @endif
        @else
            <!-- If user is not logged in, display cart from session -->
            @if(session('cart') && count(session('cart')) > 0)
                <div class="flex justify-end mb-4">
                    <button type="button" id="selectAllBtn" class="text-blue-600 hover:text-blue-800">Select All</button>
                </div>

                <div class="space-y-6">
                    @foreach (session('cart') as $id => $item)
                        <div class="border-b pb-6">
                            <div class="flex justify-between items-start">
                                <div class="flex items-start space-x-4">
                                    <div class="pt-2">
                                        <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="item-checkbox h-5 w-5">
                                    </div>
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="h-40 w-40 object-cover rounded" alt="{{ $item['name'] }}">
                                    <div>
                                        <h3 class="font-medium text-lg">{{ $item['name'] }}</h3>
                                        <p class="text-gray-500">{{ $item['variant'] ?? '' }}</p>
                                        <p class="font-bold mt-1">Rs {{ $item['price'] }}</p>
                                        
                                        <!-- Quantity controls moved here -->
                                        <div class="flex items-center mt-4">
                                            <div class="flex items-center border rounded">
                                                <button type="button" onclick="decrementQuantity({{ $id }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <span class="px-4 py-1 item-quantity" data-product-id="{{ $id }}">{{ $item['quantity'] }}</span>
                                                <button type="button" onclick="incrementQuantity({{ $id }})" class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="removeCartItem({{ $id }})" class="text-gray-600 hover:text-black">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Notes and checkout section -->
                <div class="mt-8 border rounded p-4">
                    <div class="flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        <input type="text" name="order_note" placeholder="Leave a note with your order" class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Total and checkout buttons -->
                <div class="mt-6">
                    @php
                        $sessionTotal = 0;
                        foreach(session('cart') as $item) {
                            $sessionTotal += $item['price'] * $item['quantity'];
                        }
                    @endphp
                    <div class="flex justify-between items-center font-bold text-lg mb-6">
                        <span>Total</span>
                        <span class="cart-total">Rs {{ $sessionTotal }}</span>
                    </div>
                    
                    <button type="submit" class="block w-full bg-black text-white text-center py-4 rounded-full font-medium hover:bg-gray-800 mb-3">
                        PROCEED TO CHECKOUT
                    </button>
                    
                    <a href="{{ route('shop') }}" class="block w-full bg-gray-100 text-black text-center py-4 rounded-full font-medium hover:bg-gray-200">
                        CONTINUE SHOPPING
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-xl mb-6">Your cart is empty</p>
                    <a href="{{ route('shop') }}" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800">
                        START SHOPPING
                    </a>
                </div>
            @endif
        @endif
    </form>
</div>

<script>
    // Select/Deselect all items
    document.getElementById('selectAllBtn').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.item-checkbox');
        const isAllChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = !isAllChecked;
        });
        
        this.textContent = isAllChecked ? 'Select All' : 'Deselect All';
    });

    // Form validation before checkout
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        const selectedItems = document.querySelectorAll('input[name="selected_items[]"]:checked');
        if (selectedItems.length === 0) {
            e.preventDefault();
            alert('Please select at least one product to checkout.');
        }
    });

    function incrementQuantity(productId) {
        updateCartQuantity(productId, 1);
    }
    
    function decrementQuantity(productId) {
        // Check if current quantity is greater than 1 before decrementing
        const quantityElement = event.target.closest('.flex').querySelector('.item-quantity');
        const currentQuantity = parseInt(quantityElement.textContent);
        
        if (currentQuantity > 1) {
            updateCartQuantity(productId, -1);
        }
    }
    
    function updateCartQuantity(productId, change) {
        fetch(`/cart/update-quantity/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ change: change })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update all quantity elements with the matching product ID
                document.querySelectorAll(`.item-quantity[data-product-id="${productId}"]`).forEach(el => {
                    el.textContent = data.quantity;
                });
                
                // Update the total
                if (data.total) {
                    document.querySelectorAll('.cart-total').forEach(el => {
                        el.textContent = '$' + data.total;
                    });
                }
                
                // Update cart count in header if needed
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement && data.cartCount) {
                    cartCountElement.textContent = data.cartCount;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    function removeCartItem(productId) {
        if (confirm('Are you sure you want to remove this item?')) {
            window.location.href = `/cart/remove/${productId}`;
        }
    }
</script>
@endsection
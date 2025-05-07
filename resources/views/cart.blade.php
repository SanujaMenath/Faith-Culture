@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Shopping Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <div class="bg-white shadow-sm rounded-lg">
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <div class="flex items-center p-4 border-b relative" x-data="{ quantity: {{ $item['quantity'] }} }">
                        <!-- Product Image -->
                        <div class="w-28 h-32 mr-4">
                            <img src="{{ asset('storage/' . $item['image_url']) }}" class="w-full h-full object-cover"
                                alt="{{ $item['name'] }}">
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1">
                            <h3 class="font-bold text-lg">{{ $item['name'] }}</h3>
                            <p class="text-gray-500">{{ $item['color'] ?? 'N/A' }} / {{ $item['size'] ?? 'N/A' }}</p>
                            <p class="font-semibold mt-1">LKR {{ number_format($item['price'], 0) }}</p>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="flex items-center mr-3 mt-14">
                            <button type="button"
                                x-on:click="quantity = Math.max(1, quantity - 1); $refs.q.value = quantity; $dispatch('quantity-updated', { cartId: '{{ $id }}', quantity })"
                                class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <span class="mx-3 w-5 text-center" x-text="quantity"></span>
                            <button type="button"
                                x-on:click="quantity++; $refs.q.value = quantity; $dispatch('quantity-updated', { cartId: '{{ $id }}', quantity })"
                                class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <input type="hidden" x-ref="q" value="{{ $item['quantity'] }}">
                        </div>


                        <!-- Remove Button -->
                        <button type="button" onclick="removeItem('{{ $id }}')"
                            class="absolute top-2 right-2  flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full">
                            <i class="fa-solid fa-circle-xmark fa-1x"></i>
                        </button>
                    </div>
                @endforeach

                <!-- Note Section -->
                <div class="p-4 border-b flex items-center">
                    <button class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-gray-200 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <input type="text" placeholder="Leave a note with your order"
                        class="w-full bg-transparent focus:outline-none">
                </div>

                <!-- Total Section -->
                <div class="p-4 flex justify-between items-center">
                    <span class="font-bold text-lg">Total</span>
                    <span class="font-bold text-lg">LKR {{ number_format($total, 0) }}</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 space-y-3">
                <button type="button" onclick="proceedToCheckout()"
                    class="w-full bg-black text-white py-4 rounded font-semibold hover:bg-gray-800 transition">
                    CHECK OUT
                </button>
                <button type="button" onclick="window.location.href='{{ route('shop') }}'"
                    class="w-full bg-gray-100 text-black py-4 rounded font-semibold hover:bg-gray-200 transition">
                    CONTINUE SHOPPING
                </button>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-xl mb-6">Your cart is empty.</p>
                <a href="{{ route('shop.index') }}"
                    class="inline-block bg-black text-white px-6 py-3 rounded font-semibold hover:bg-gray-800 transition">
                    Continue Shopping
                </a>
            </div>
        @endif
    </div>

    <form id="removeItemForm" action="{{ route('cart.remove') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="cart_id" id="remove_cart_id">
    </form>

    <form id="updateQuantityForm" action="{{ route('cart.update') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="cart_id" id="update_cart_id">
        <input type="hidden" name="quantity" id="update_quantity">
    </form>

    <script>
        // For updating quantity in real-time
        document.addEventListener('quantity-updated', function (event) {
            const { cartId, quantity } = event.detail;

            const form = document.getElementById('updateQuantityForm');
            form.querySelector('#update_cart_id').value = cartId;
            form.querySelector('#update_quantity').value = quantity;

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.total) {
                        // Update total (if you wrap it in a span with a class)
                        const totalSpan = document.querySelector('.total-price');
                        if (totalSpan) totalSpan.textContent = 'LKR ' + data.total;
                    }
                })
                .catch(error => console.error('Error updating cart:', error));
        });

        // For removing items
        function removeItem(cartId) {
            document.getElementById('remove_cart_id').value = cartId;
            document.getElementById('removeItemForm').submit();
        }

        // For checkout
        function proceedToCheckout() {
            window.location.href = "{{ route('checkout') }}";
        }
    </script>
@endsection
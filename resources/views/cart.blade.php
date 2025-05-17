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
            <form id="checkoutForm" action="{{ route('cart.checkout') }}" method="POST">
                <div class="bg-white shadow-sm rounded-lg">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <div class="flex items-center p-4 border-b relative" data-cart-id="{{ $id }}">
                            <!-- Checkbox -->
                            <div class="mr-4 ">
                                <input type="checkbox" name="selected_items[]" value="{{ $id }}" class="w-5 h-5 accent-gray-600">
                            </div>

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
                                <button type="button" onclick="updateQuantity('{{ $id }}', -1)"
                                    class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300"
                                    @if($item['quantity'] <= 1) disabled @endif>
                                    <i class="fa-solid fa-minus"></i>
                                </button>

                                <span class="mx-3 w-5 text-center cart-quantity">{{ $item['quantity'] }}</span>

                                <button type="button" onclick="updateQuantity('{{ $id }}', 1)"
                                    class="w-8 h-8 flex items-center justify-center bg-gray-200 rounded-full hover:bg-gray-300">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                                <input type="hidden" id="update-quantity-{{ $id }}" value="{{ $item['quantity'] }}">
                            </div>

                            <!-- Remove Button -->
                            <button type="button" onclick="removeItem('{{ $id }}')"
                                class="absolute top-2 right-2 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full p-1">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </div>
                    @endforeach

                    <!-- Total Section -->
                    <div class="p-4 flex justify-between items-center">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-lg total-price">LKR {{ number_format($total, 0) }}</span>
                    </div>
                </div>

                <!-- Note Section -->
                <div class="mt-3 p-3 border rounded-md flex items-center">
                    <button class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-full hover:bg-gray-200 mr-3">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <input type="text" placeholder="Leave a note with your order" name="note"
                        class="w-full bg-transparent focus:outline-none" value="{{ old('note') }}">
                </div>

                <!-- Checkout or Shopping -->
                @csrf
                <div class="mt-6 space-y-3">
                    <button type="submit"
                        class="w-full bg-black text-white py-4 rounded-full font-semibold hover:bg-gray-800 transition">CHECK
                        OUT</button>
                    <button type="button" onclick="window.location.href='{{ route('shop') }}'"
                        class="w-full bg-gray-200 text-black py-4 rounded-full font-semibold hover:bg-gray-300 transition">CONTINUE
                        SHOPPING</button>
                </div>
            </form>

        @else
            <div class="text-center py-12">
                <p class="text-xl mb-6">Your cart is empty.</p>
                <a href="{{ route('shop') }}"
                    class="inline-block bg-black text-white px-6 py-3 rounded font-semibold hover:bg-gray-800 transition">Continue
                    Shopping</a>
            </div>
        @endif
    </div>

    <!-- Hidden Forms -->
    <form id="removeItemForm" action="{{ route('cart.remove') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="cart_id" id="remove_cart_id">
    </form>

    <script>
        function updateQuantity(cartId, change) {
            const input = document.querySelector(`#update-quantity-${cartId}`);
            let newQty = parseInt(input.value) + change;

            if (newQty < 1) return;

            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: newQty
                }),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Update quantity display
                        const container = document.querySelector(`[data-cart-id="${cartId}"]`);
                        if (container) {
                            container.querySelector('.cart-quantity').textContent = data.quantity;
                            document.querySelector(`#update-quantity-${cartId}`).value = data.quantity;
                        }

                        // Update total price
                        const totalSpan = document.querySelector('.total-price');
                        if (totalSpan) totalSpan.textContent = 'LKR ' + data.total;
                    }
                })
                .catch(err => {
                    alert('Failed to update cart. Please try again.');
                    console.error(err);
                });
        }

        function removeItem(cartId) {
            if (confirm("Are you sure you want to remove this item?")) {
                document.getElementById('remove_cart_id').value = cartId;
                document.getElementById('removeItemForm').submit();
            }
        }

    </script>
@endsection
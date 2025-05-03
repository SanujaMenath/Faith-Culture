@extends('layouts.app')

@section('title', 'Your Cart - Faith Culture')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>

    @if(Auth::check()) 
        <!-- If user is logged in, display cart from the database -->
        @if($cartItems->isNotEmpty())
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Product</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Total</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cartItems as $item)
                        @php $total += $item->product->price * $item->quantity; @endphp
                        <tr class="border-b">
                            <td class="py-2">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $item->product->image_url) }}" class="h-12 w-12 object-cover rounded">
                                    <div>{{ $item->product->name }}</div>
                                </div>
                            </td>
                            <td class="py-2">
                                <form method="POST" action="{{ route('cart.update', $item->product_id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-16 border p-1">
                                    <button class="ml-2 text-blue-600 hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="py-2">${{ $item->product->price }}</td>
                            <td class="py-2">${{ $item->product->price * $item->quantity }}</td>
                            <td class="py-2">
                                <a href="{{ route('cart.remove', $item->product_id) }}" class="text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-bold">
                        <td colspan="3" class="text-right py-4">Total:</td>
                        <td>${{ $total }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6">
                <a href="{{ route('cart.clear') }}" class="text-red-500 hover:underline">Clear Cart</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif

    @else 
        <!-- If user is not logged in, display cart from session -->
        @if(session('cart') && count(session('cart')) > 0)
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Product</th>
                        <th class="py-2">Quantity</th>
                        <th class="py-2">Price</th>
                        <th class="py-2">Total</th>
                        <th class="py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach (session('cart') as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr class="border-b">
                            <td class="py-2">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="h-12 w-12 object-cover rounded">
                                    <div>{{ $item['name'] }}</div>
                                </div>
                            </td>
                            <td class="py-2">
                                <form method="POST" action="{{ route('cart.update', $id) }}">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" class="w-16 border p-1">
                                    <button class="ml-2 text-blue-600 hover:underline">Update</button>
                                </form>
                            </td>
                            <td class="py-2">${{ $item['price'] }}</td>
                            <td class="py-2">${{ $item['price'] * $item['quantity'] }}</td>
                            <td class="py-2">
                                <a href="{{ route('cart.remove', $id) }}" class="text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-bold">
                        <td colspan="3" class="text-right py-4">Total:</td>
                        <td>${{ $total }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6">
                <a href="{{ route('cart.clear') }}" class="text-red-500 hover:underline">Clear Cart</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    @endif
</div>
@endsection

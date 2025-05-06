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

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 text-left">Image</th>
                        <th class="p-2 text-left">Color / Size</th>
                        <th class="p-2 text-left">Quantity</th>
                        <th class="p-2 text-left">Price</th>
                        <th class="p-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr class="border-t">
                            <td class="p-2">
                                <img src="{{ asset('storage/' . $item['image_url']) }}" class="w-16 h-16 object-cover">
                            </td>
                            <td class="p-2">
                                {{ $item['color'] }} / {{ $item['size'] }}
                            </td>
                            <td class="p-2">{{ $item['quantity'] }}</td>
                            <td class="p-2">Rs. {{ number_format($item['price'], 2) }}</td>
                            <td class="p-2">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $id }}">
                                    <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                </form>


                            </td>
                        </tr>
                    @endforeach
                    <tr class="font-bold border-t">
                        <td colspan="3" class="p-2 text-right">Total:</td>
                        <td class="p-2">Rs. {{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
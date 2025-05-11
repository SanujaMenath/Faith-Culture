@extends('layouts.app')

@section('title', 'Orders - Faith Culture')

@section('content')
    <section class="">
        <div class="mx-auto px-8 py-8">
            <h1 class="text-3xl font-bold mb-6">Your Orders</h1>

            @if($orders->isEmpty())
                <p class="text-gray-500">You have no orders yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="flex items-start border p-4 rounded-lg shadow-md space-x-4">
                            {{-- Product Image --}}
                            <div class="w-32 h-40 flex-shrink-0 overflow-hidden rounded">
                                @if($order->inventory && $order->inventory->product && $order->inventory->image_url)
                                    <img src="{{ asset('storage/' . $order->inventory->image_url) }}" alt="Product Image"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                        No Image
                                    </div>
                                @endif
                            </div>

                            {{-- Order Details --}}
                            <div class="flex-1">
                                <p><strong>Product:</strong> {{ $order->inventory?->product?->name ?? 'N/A' }}</p>
                                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                                <p><strong>Price:</strong> Rs. {{ number_format($order->price, 2) }}</p>
                                <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                                <p><strong>Payment Status:</strong>
                                    <span class="{{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-yellow-600' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </p>
                                <p><strong>Ordered At:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
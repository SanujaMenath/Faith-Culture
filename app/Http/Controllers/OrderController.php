<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Stripe\Stripe;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders');
    }

    public function showOrders()
    {
        $user = auth()->user();
        $orders = Order::with('inventory.product')->where('user_id', $user->id)->latest()->get();

        return view('orders', compact('orders'));
    }


    public function checkoutSuccess(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::with('inventory')->where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $shippingAddress = session('shipping_address');

        // Save order logic
        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user->id,
                'inventory_id' => $item->inventory_id,
                'quantity' => $item->quantity,
                'price' => $item->inventory->price,
                'shipping_address' => $shippingAddress,
                'payment_status' => 'paid',
            ]);
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('orders.show')->with('success', 'Payment successful and order placed.');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{


    public function index()
    {
        $sessionCart = session('checkout_items', []);

        if (empty($sessionCart)) {
            return redirect()->route('cart.index')->with('error', 'No items found in checkout session.');
        }

        $cartItems = Cart::with(['inventory.product', 'inventory.color', 'inventory.size'])
            ->whereIn('id', $sessionCart)
            ->get();

        return view('checkout', compact('cartItems'));
    }


    public function processCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:cod,card',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'special_instructions' => 'nullable|string|max:500',
        ]);


        session(['shipping_address' => $request->address]);
        session(['telephone' => $request->phone]);
        session(['email' => $request->email]);
        session(['city' => $request->city]);
        session(['postal_code' => $request->postal_code]);
        session(['special_instructions' => $request->special_instructions]);


        if ($request->payment_method === 'card') {
            $user = auth()->user();
            $cartItems = Cart::with(['inventory.product'])->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            $lineItems = [];

            foreach ($cartItems as $item) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $item->inventory->product->name,
                        ],
                        'unit_amount' => $item->inventory->price * 100,
                    ],
                    'quantity' => $item->quantity,
                ];
            }

            Stripe::setApiKey(config('services.stripe.secret'));

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
                'customer_email' => $user->email,
            ]);

            return redirect($session->url);
        }

        $user = auth()->user();
        $cartItems = Cart::with('inventory')->where('user_id', $user->id)->get();

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => $user->id,
                'inventory_id' => $item->inventory_id,
                'quantity' => $item->quantity,
                'price' => $item->inventory->price,
                'shipping_address' => $request->address,
                'telephone' => $request->phone,
                'email' => $request->email,
                'payment_status' => 'pending',
                'special_instructions' => trim(($request->special_instructions ?? '') . "\n" . (session('checkout_note') ?? '')),
            ]);
        }

        Cart::where('user_id', $user->id)->delete();
        // COD fallback
        return redirect()->route('orders.show')->with('success', 'Order placed successfully! Please pay on delivery.');
    }

}

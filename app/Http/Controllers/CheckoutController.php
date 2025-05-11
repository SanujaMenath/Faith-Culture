<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
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
        ]);

        if ($request->payment_method === 'card') {
            $user = auth()->user();
            $cartItems = Cart::with(['inventory.product'])->where('user_id', $user->id)->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            session(['shipping_address' => $request->address]);
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

        // COD fallback
        return redirect()->route('orders.show')->with('success', 'Order placed successfully! Please pay on delivery.');
    }

}

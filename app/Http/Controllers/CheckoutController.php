<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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

        // Make sure product_id exists
        $productIds = [];
        foreach ($sessionCart as $item) {
            if (isset($item['product_id'])) {
                $productIds[] = $item['product_id'];
            }
        }

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $cartItems = collect($sessionCart)->map(function ($item) use ($products) {
            $product = $products->get($item['product_id'] ?? null);
            $item['product'] = $product;
            return $item;
        });

        return view('checkout', compact('cartItems'));
    }


    public function processCheckout(Request $request)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string|in:credit_card,paypal',
        ]);

        $validated = $request->validate([
            'payment_method' => 'required|in:cod,card',
            // add other validations here
        ]);

        if ($validated['payment_method'] === 'cod') {
            return redirect()->route('orders.show')->with('success', 'Order placed successfully! Please pay on delivery.');
        } else {
            // Redirect to card payment gateway
            return redirect()->route('orders.confirm')->with('success', 'Order placed successfully!');
        }

    }
}

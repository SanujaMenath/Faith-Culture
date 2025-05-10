<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
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

        $cartItems = Cart::with(['inventory.product', 'inventory.color', 'inventory.size'])
            ->whereIn('id', $sessionCart)
            ->get();

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

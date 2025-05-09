<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        return view('checkout');
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

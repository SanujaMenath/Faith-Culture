<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders');
    }

    public function showOrders()
    {
        return view('orders.orders');
    }

    public function placeOrder(Request $request)
{
    $validated = $request->validate([
        'payment_method' => 'required|in:cod,card',
        // add other validations here
    ]);

    if ($validated['payment_method'] === 'cod') {
        // Process COD logic
    } else {
        // Redirect to card payment gateway
    }
}

}

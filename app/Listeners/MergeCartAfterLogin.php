<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Cart;

class MergeCartAfterLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;
        $sessionCart = session()->get('cart', []);

        foreach ($sessionCart as $productId => $details) {
            $existing = Cart::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->first();

            if ($existing) {
                $existing->quantity += $details['quantity'];
                $existing->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $details['quantity'],
                ]);
            }
        }

        session()->forget('cart'); // Clear session cart after merging
    }
}



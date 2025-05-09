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

        foreach ($sessionCart as $key => $details) {
            // Assuming key format: inventoryId-color-size
            $parts = explode('-', $key);
            $inventoryId = $parts[0] ?? null;

            if (!$inventoryId) continue;

            // Check if this cart item already exists for the user (with same inventory)
            $existing = Cart::where('user_id', $user->id)
                ->where('inventory_id', $inventoryId)
                ->first();

            if ($existing) {
                $existing->quantity += $details['quantity'];
                $existing->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'inventory_id' => $inventoryId,
                    'quantity' => $details['quantity'],
                ]);
            }
        }

        session()->forget('cart'); // Clear session cart after merging
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Auth;
use Illuminate\Http\Request;
use App\Models\Inventory;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = \App\Models\Cart::with('product', 'product.inventories')
            ->where('user_id', auth()->id())
            ->get();
    
        // Convert to the array structure expected by the Blade view
        $cart = [];
    
        foreach ($cartItems as $item) {
            $inventory = $item->product->inventories->first(); 
    
            $cart[$item->id] = [
                'color' => optional($inventory)->color,
                'size' => optional($inventory)->size,
                'price' => $item->product->inventories->first()->price ?? 0,
                'image_url' => $inventory->image_url ?? 'default.png',
                'quantity' => $item->quantity,
            ];
        }
    
        return view('cart', compact('cart'));
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variant_id' => 'required|exists:inventory,id',
        ]);
    
        $userId = Auth::id(); // Ensure user is logged in
        $variant = Inventory::findOrFail($request->variant_id);
    
        // Check if already exists in user's cart
        $existing = Cart::where('user_id', $userId)
                        ->where('product_id', $request->product_id)
                        ->first();
    
        if ($existing) {
            $existing->quantity += 1;
            $existing->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }
    
        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function remove(Request $request)
{
    $request->validate(['cart_id' => 'required|integer']);

    Cart::where('id', $request->cart_id)
        ->where('user_id', auth()->id())
        ->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
}

}

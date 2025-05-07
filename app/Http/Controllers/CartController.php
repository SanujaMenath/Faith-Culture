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
        $cart = [];

        if (auth()->check()) {
            $cartItems = Cart::with(['inventory.color', 'inventory.size'])->where('user_id', auth()->id())->get();

            foreach ($cartItems as $item) {
                $variant = $item->inventory;
                $cart[$item->id] = [
                    'color' => $variant->color->name ?? 'N/A',
                    'size' => $variant->size->name ?? 'N/A',
                    'price' => $variant->price,
                    'image_url' => $variant->image_url,
                    'quantity' => $item->quantity,
                ];
            }
        } else {
            $cart = session()->get('cart', []);
        }

        return view('cart', compact('cart'));
    }


    public function add(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventory,id',
        ]);

        $variant = Inventory::with('color', 'size')->findOrFail($request->inventory_id);

        if (auth()->check()) {
            // Logged-in user - use DB
            $userId = auth()->id();

            $cartItem = Cart::firstOrNew([
                'user_id' => $userId,
                'inventory_id' => $request->inventory_id,
            ]);

            $cartItem->quantity += 1;
            $cartItem->save();

        } else {
            // Guest - use session
            $cart = session()->get('cart', []);

            if (isset($cart[$request->inventory_id])) {
                $cart[$request->inventory_id]['quantity'] += 1;
            } else {
                $cart[$request->inventory_id] = [
                    'inventory_id' => $request->inventory_id,
                    'color' => $variant->color->name,
                    'size' => $variant->size->name,
                    'price' => $variant->price,
                    'image_url' => $variant->image_url,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }


    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required',
        ]);

        if (auth()->check()) {
            // From DB
            Cart::where('id', $request->cart_id)
                ->where('user_id', auth()->id())
                ->delete();
        } else {
            // From session
            $cart = session()->get('cart', []);
            unset($cart[$request->cart_id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }


}

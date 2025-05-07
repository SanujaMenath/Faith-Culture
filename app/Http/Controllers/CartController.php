<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Inventory;

class CartController extends Controller
{
    public function index()
    {
        $cart = [];

        if (auth()->check()) {
            $cartItems = Cart::with(['inventory.color', 'inventory.size', 'inventory.product'])->where('user_id', auth()->id())->get();

            foreach ($cartItems as $item) {
                $variant = $item->inventory;
                $cart[$item->id] = [
                    'name' => $variant->product->name ?? 'Product',  // Add product name
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

        $variant = Inventory::with(['color', 'size', 'product'])->findOrFail($request->inventory_id);

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
                    'name' => $variant->product->name ?? 'Product',  // Add product name
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

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartId = $request->input('cart_id');
        $quantity = $request->input('quantity');

        if (auth()->check()) {
            // For logged-in users, cart_id is the Cart model ID
            $cartItem = Cart::where('id', $cartId)
                ->where('user_id', auth()->id())
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();

                // Calculate new total for response
                $total = Cart::where('user_id', auth()->id())
                    ->join('inventory', 'carts.inventory_id', '=', 'inventory.id')
                    ->sum(DB::raw('inventory.price * carts.quantity'));

                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Cart updated successfully',
                        'total' => number_format($total, 0)
                    ]);
                }

                return redirect()->back()->with('success', 'Cart updated successfully');
            }
        } else {
            // For guests, using session
            $cart = session()->get('cart', []);

            // Check if the item exists in the cart
            if (isset($cart[$cartId])) {
                // Update the quantity
                $cart[$cartId]['quantity'] = $quantity;

                // Save back to session
                session()->put('cart', $cart);

                // Calculate new total
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                }

                // If it's an AJAX request, return JSON response
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Cart updated successfully',
                        'total' => number_format($total, 0)
                    ]);
                }

                return redirect()->back()->with('success', 'Cart updated successfully');
            }
        }

        // If it's an AJAX request, return error
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart'
            ]);
        }

        return redirect()->back()->with('error', 'Item not found in cart');
    }

}

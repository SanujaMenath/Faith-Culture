<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = [];

        if (auth()->check()) {
            $cartItems = Cart::with(['inventory.color', 'inventory.size', 'inventory.product'])
                ->where('user_id', auth()->id())
                ->get();

            foreach ($cartItems as $item) {
                $variant = $item->inventory;
                $cart[$item->id] = [
                    'name' => $variant->product->name ?? 'Product',
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
            'quantity' => 'required|integer|min:1',
        ]);
        $quantity = $request->quantity;
        $variant = Inventory::with(['color', 'size', 'product'])->findOrFail($request->inventory_id);

        if (auth()->check()) {
            $cartItem = Cart::firstOrNew([
                'user_id' => auth()->id(),
                'inventory_id' => $variant->id,
            ]);
            $cartItem->quantity = ($cartItem->exists ? $cartItem->quantity : 0) + $quantity;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);
            $id = (string) $variant->id;

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $quantity;
            } else {
                $cart[$id] = [
                    'inventory_id' => $variant->id,
                    'name' => $variant->product->name ?? 'Product',
                    'color' => $variant->color->name ?? 'N/A',
                    'size' => $variant->size->name ?? 'N/A',
                    'price' => $variant->price,
                    'image_url' => $variant->image_url,
                    'quantity' => $quantity,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function remove(Request $request)
    {
        $request->validate(['cart_id' => 'required']);

        if (auth()->check()) {
            Cart::where('id', $request->cart_id)
                ->where('user_id', auth()->id())
                ->delete();
        } else {
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
            'quantity' => 'required|integer|min:1',
        ]);

        $cartId = $request->cart_id;
        $quantity = $request->quantity;

        if (auth()->check()) {
            $cartItem = Cart::where('id', $cartId)
                ->where('user_id', auth()->id())
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();

                $total = Cart::where('user_id', auth()->id())
                    ->join('inventory', 'carts.inventory_id', '=', 'inventory.id')
                    ->sum(DB::raw('inventory.price * carts.quantity'));

                return response()->json(['success' => true, 'total' => number_format($total, 0), 'quantity' => $quantity]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$cartId])) {
                $cart[$cartId]['quantity'] = $quantity;
                session()->put('cart', $cart);

                $total = collect($cart)->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                });

                return response()->json(['success' => true, 'total' => number_format($total, 0)]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

    public function checkout(Request $request)
{
    $selectedIds = $request->input('selected_items', []);
    $note = $request->input('note');

    if (empty($selectedIds)) {
        return redirect()->back()->with('error', 'Please select at least one item to checkout.');
    }

    $cart = session()->get('cart', []);

      $selectedCart = array_filter($cart, function ($key) use ($selectedIds) {
            return in_array($key, $selectedIds);
        }, ARRAY_FILTER_USE_KEY);

    session()->put('checkout_items', $selectedCart);
    session()->put('checkout_note', $note);


    return redirect()->route('checkout.index')->with('success', 'Items ready for checkout.');
}



}

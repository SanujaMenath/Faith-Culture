<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
            return view('cart', compact('cartItems'));
        }
        
        $cart = session()->get('cart', []);
        return view('cart', ['sessionCart' => $cart]);
    }
    
    public function add(Product $product)
    {
        if (Auth::check()) {
            // Check if item already in cart
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();
            
            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
            } else {
                $cart[$product->id] = [
                    "name" => $product->name,
                    "price" => $product->price,
                    "image" => $product->image_url,
                    "quantity" => 1
                ];
            }
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    public function update(Request $request, Product $product)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->update(['quantity' => $request->quantity]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }
        
        return redirect()->back();
    }
    
    public function remove(Product $product)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$product->id])) {
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
        }
        
        return redirect()->back()->with('success', 'Product removed!');
    }
    
    public function clear()
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }
        
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    /**
     * Update the quantity of an item in the cart with increment/decrement.
     *
     * @param  Product  $product
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateQuantity(Product $product, Request $request)
    {
        $change = $request->input('change', 0);

        if (Auth::check()) {
            // User is logged in, update the database
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                $newQuantity = max(1, $cartItem->quantity + $change);
                $cartItem->quantity = $newQuantity;
                $cartItem->save();

                // Calculate new total
                $total = Cart::where('user_id', Auth::id())
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->selectRaw('SUM(products.price * carts.quantity) as total')
                    ->value('total');

                return response()->json([
                    'success' => true,
                    'quantity' => $newQuantity,
                    'total' => $total
                ]);
            }
        } else {
            // User is not logged in, update the session
            $cart = session()->get('cart', []);

            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity'] = max(1, $cart[$product->id]['quantity'] + $change);
                session()->put('cart', $cart);

                // Calculate new total
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['price'] * $item['quantity'];
                }

                return response()->json([
                    'success' => true,
                    'quantity' => $cart[$product->id]['quantity'],
                    'total' => $total
                ]);
            }
        }

        return response()->json(['success' => false], 404);
    }
}
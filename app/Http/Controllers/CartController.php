<?php

namespace App\Http\Controllers;

use App\Services\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getCart();
        $total = Cart::totalPrice();
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // 1. Get quantity already in cart for THIS product
        $cart = Cart::getCart();
        $alreadyInCart = $cart[$product->id]['quantity'] ?? 0;

        // 2. Total if we add
        $totalWanted = $alreadyInCart + $request->quantity;

        // 3. Check against real database stock
        if ($totalWanted > $product->stock) {
            $remaining = $product->stock - $alreadyInCart;
            return back()->with('error', "You already have $alreadyInCart in your cart. Only $remaining more left.");
        }

        Cart::add($product->id, $request->quantity);
        return back()->with('success', 'Added to cart!');
    }
    public function remove($productId)
    {
        Cart::remove($productId);
        return back()->with('success', 'Removed from cart.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return back()->withErrors(['quantity' => 'Only ' . $product->stock . ' item(s) available.']);
        }

        Cart::update($request->product_id, $request->quantity);
        return back()->with('success', 'Cart updated.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Services\Cart;
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
            'quantity' => 'nullable|integer|min:1'
        ]);
        Cart::add($request->product_id, $request->quantity ?? 1);
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
        Cart::update($request->product_id, $request->quantity);
        return back()->with('success', 'Cart updated.');
    }
}
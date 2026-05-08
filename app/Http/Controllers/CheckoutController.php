<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Session;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getCart();
        if (empty($cartItems))
            return redirect()->route('cart.index')->with('error', 'Cart is empty.');
        $total = Cart::totalPrice();
        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function placeOrder()
    {
        $cartItems = Cart::getCart();
        if (empty($cartItems))
            return back()->with('error', 'Cart empty.');

        foreach ($cartItems as $id => $item) {
            $product = Product::find($id);
            if (!$product || $product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$item['name']}. Only {$product->stock} left.");
            }
        }

        $total = Cart::totalPrice();
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $product = Product::find($id);
            if ($product) {
                $product->decrement('stock', $item['quantity']);
            }
        }


        // Clear the cart
        Session::forget('cart');

        return redirect()->route('payment.show', $order)->with('success', 'Order placed!');
    }
}

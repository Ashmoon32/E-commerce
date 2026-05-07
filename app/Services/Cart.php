<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    // Get the whole cart from session (or empty array)
    public static function getCart()
    {
        return Session::get('cart', []);
    }

    // Save the whole cart array back to session
    public static function saveCart($cart)
    {
        Session::put('cart', $cart);
    }

    // Add a product
    public static function add($productId, $quantity = 1)
    {
        $cart = self::getCart();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }
        self::saveCart($cart);
    }

    // Remove a product
    public static function remove($productId)
    {
        $cart = self::getCart();
        unset($cart[$productId]);
        self::saveCart($cart);
    }

    // Update quantity
    public static function update($productId, $quantity)
    {
        $cart = self::getCart();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, (int) $quantity);
            self::saveCart($cart);
        }
    }

    // Get total cart items count (optional)
    public static function totalItems()
    {
        $total = 0;
        foreach (self::getCart() as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    // Get cart total price
    public static function totalPrice()
    {
        $total = 0;
        foreach (self::getCart() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
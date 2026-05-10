<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    // Get the whole cart from session (or empty array)
    public static function getCart()
    {
        $cart = Session::get(self::getSessionKey(), []);
        // Remove expired items on every access
        $cart = self::removeExpiredItemsFromArray($cart);
        Session::put(self::getSessionKey(), $cart); // save cleaned cart back
        return $cart;
    }

    // Get session key based on user
    private static function getSessionKey()
    {
        return 'cart_' . (auth()->check() ? auth()->id() : 'guest');
    }

    // Clean expired items from a given cart array (without saving)
    private static function removeExpiredItemsFromArray($cart)
    {
        $cutoff = now()->subHours(24)->timestamp;   // change to subMinutes(1) for testing
        foreach ($cart as $id => $item) {
            if (isset($item['added_at']) && $item['added_at'] < $cutoff) {
                unset($cart[$id]);
            }
        }
        return $cart;
    }

    // Save the whole cart array back to session
    public static function saveCart($cart)
    {
        Session::put(self::getSessionKey(), $cart);
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
                'added_at' => now()->timestamp,
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

    public static function mergeGuestCart()
    {
        if (!auth()->check())
            return;

        $guestKey = 'cart_guest';
        $guestCart = Session::get($guestKey, []);
        if (empty($guestCart))
            return;

        $userKey = 'cart_' . auth()->id();
        $userCart = Session::get($userKey, []);

        // Merge guest items into user cart
        foreach ($guestCart as $productId => $item) {
            if (isset($userCart[$productId])) {
                $userCart[$productId]['quantity'] += $item['quantity'];
            } else {
                $userCart[$productId] = $item;
            }
        }

        Session::put($userKey, $userCart);
        Session::forget($guestKey);   // clear the guest cart
    }
    public static function clear()
    {
        Session::forget(self::getSessionKey());
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Popular products (global)
        $popularProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->groupBy('products.id')
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
            ->take(5)
            ->get();

        // New arrivals
        $latestProducts = Product::latest()->take(4)->get();

        // Categories
        $categories = Category::all();

        // Best-selling product per category (to show its image)
        $categoryPopularProducts = [];
        foreach ($categories as $category) {
            $popularProduct = Product::select('products.*')
                ->join('order_items', 'products.id', '=', 'order_items.product_id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('orders.status', 'paid')
                ->where('products.category_id', $category->id)
                ->groupBy('products.id')
                ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
                ->first();
            $categoryPopularProducts[$category->id] = $popularProduct;
        }

        return view('home', compact(
            'popularProducts',
            'latestProducts',
            'categories',
            'categoryPopularProducts'
        ));
    }

    public function about()
    {
        return view('about');
    }
}

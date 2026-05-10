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
        // Popular (best selling, paid orders only)
        $popularProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->groupBy('products.id')
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
            ->take(5)
            ->get();

        // New arrivals (latest 4)
        $latestProducts = Product::latest()->take(4)->get();

        // Categories for the "Shop by Category" section
        $categories = Category::all();

        return view('home', compact('popularProducts', 'latestProducts', 'categories'));
    }

    public function about()
    {
        return view('about');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function index()
    {
        // Get top 5 popular products based on total quantity sold (paid orders only)
        $popularProducts = Product::select('products.*')
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.status', 'paid')
            ->groupBy('products.id')
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
            ->take(5)
            ->get();

        return view('home', compact('popularProducts'));
    }

    public function about()
    {
        return view('about');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure user owns the order
        if ($order->user_id !== auth()->id())
            abort(403);
        return view('orders.show', compact('order'));
    }
}

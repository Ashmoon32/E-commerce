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

    public function cancel(Order $order)
    {
        // Only owner, only pending orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        // Restore stock for each item
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order)->with('success', 'Order cancelled, stock restored.');
    }
}

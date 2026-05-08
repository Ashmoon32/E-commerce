<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        if ($order->status != 'pending') {
            return redirect()->route('orders.show', $order)->with('error', 'Order already processed.');
        }

        return view('payment.select', compact('order'));
    }

    public function pay(Request $request, Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:kbz_pay,wave_pay,aya_pay,bank'
        ]);

        $order->update([
            'payment_method' => $validated['payment_method'],
            'status' => 'paid',
        ]);

        // We are handled the stock decrement in the Order place
        // foreach ($order->items as $item) {
        //     $product = $item->product;
        //     if ($product) {
        //         $product->decrement('stock', $item->quantity);
        //     }
        // }

        return redirect()->route('payment.success', $order);
    }

    public function success(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('payment.success', compact('order'));
    }
}

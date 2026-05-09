<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class CancelUnpaidOrders extends Command
{
    protected $signature = 'orders:cancel-unpaid';
    protected $description = 'Cancel pending orders older than 30 minutes and restore stock';

    public function handle()
    {
        $cutoff = now()->subMinutes(1);
        $orders = Order::where('status', 'pending')
            ->where('created_at', '<', $cutoff)
            ->get();

        foreach ($orders as $order) {
            // restore stock
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
            $order->update(['status' => 'cancelled']);
            $this->info("Order #{$order->id} cancelled, stock restored.");
        }

        if ($orders->isEmpty()) {
            $this->info('No unpaid orders to cancel.');
        }
    }
}
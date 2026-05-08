@extends('layouts.app')

@section('content')
    <a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-black">&larr; Back to Orders</a>
    <h1 class="text-3xl font-light mt-2 mb-2">Order #{{ $order->id }}</h1>
    <p class="text-sm text-gray-500 mb-6">Status: <span class="font-semibold uppercase">{{ $order->status }}</span></p>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 mb-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3 font-normal">Product</th>
                    <th class="text-left p-3 font-normal">Price</th>
                    <th class="text-left p-3 font-normal">Qty</th>
                    <th class="text-left p-3 font-normal">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($order->items as $item)
                    <tr>
                        <td class="p-3">{{ $item->product->name }}</td>
                        <td class="p-3">${{ number_format($item->price, 2) }}</td>
                        <td class="p-3">{{ $item->quantity }}</td>
                        <td class="p-3">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="text-xl font-light">Total: <span class="font-semibold">${{ number_format($order->total, 2) }}</span></p>
@endsection
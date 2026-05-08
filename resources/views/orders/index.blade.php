@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-6">Your Orders</h1>
    @if($orders->isEmpty())
        <p class="text-gray-500">No orders yet.</p>
    @else
        <div class="divide-y divide-gray-200 border border-gray-200">
            @foreach($orders as $order)
                <div class="p-4 flex justify-between items-center hover:bg-gray-50">
                    <div>
                        <a href="{{ route('orders.show', $order) }}" class="text-black font-semibold hover:underline">Order
                            #{{ $order->id }}</a>
                        <span class="text-sm text-gray-500 ml-2">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="text-right">
                        <span class="font-light">${{ number_format($order->total, 2) }}</span>
                        <span
                            class="ml-4 text-xs uppercase tracking-wide {{ $order->status === 'pending' ? 'text-gray-600' : 'text-green-600' }}">{{ $order->status }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
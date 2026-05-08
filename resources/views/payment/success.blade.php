@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto text-center mt-10">
        <h1 class="text-3xl font-light mb-4">Thank You!</h1>
        <p class="text-gray-600 mb-6">Your payment via
            <strong>{{ strtoupper(str_replace('_', ' ', $order->payment_method)) }}</strong> was successful.</p>
        <p class="text-sm text-gray-500">Order #{{ $order->id }} – ${{ number_format($order->total, 2) }}</p>
        <a href="{{ route('orders.show', $order) }}"
            class="mt-6 inline-block border border-black px-6 py-2 text-sm hover:bg-black hover:text-white transition">
            View Order
        </a>
    </div>
@endsection
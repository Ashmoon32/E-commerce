@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-6">Choose Payment Method</h1>
    <p class="mb-4">Order #{{ $order->id }} – Total: <strong>${{ number_format($order->total, 2) }}</strong></p>

    <form action="{{ route('payment.pay', $order) }}" method="POST" class="max-w-md space-y-4">
        @csrf

        <label class="flex items-center space-x-3 border border-gray-200 p-3 cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="kbz_pay" required>
            <span>KBZ Pay</span>
        </label>

        <label class="flex items-center space-x-3 border border-gray-200 p-3 cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="wave_pay">
            <span>Wave Pay</span>
        </label>

        <label class="flex items-center space-x-3 border border-gray-200 p-3 cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="aya_pay">
            <span>AYA Pay</span>
        </label>

        <label class="flex items-center space-x-3 border border-gray-200 p-3 cursor-pointer hover:bg-gray-50">
            <input type="radio" name="payment_method" value="bank">
            <span>Bank Transfer</span>
        </label>

        <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition w-full">
            Pay Now
        </button>
    </form>
@endsection
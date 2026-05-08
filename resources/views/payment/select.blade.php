@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-6">Choose Payment Method</h1>
    <p class="mb-4">Order #{{ $order->id }} – Total: <strong>${{ number_format($order->total, 2) }}</strong></p>

    <form action="{{ route('payment.pay', $order) }}" method="POST" class="max-w-md space-y-4">
        @csrf

        <!-- KBZ Pay -->
        <label class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-black group">
            <input type="radio" name="payment_method" value="kbz_pay" required class="sr-only">
            <img src="{{ asset('images/payments/kbz.png') }}" alt="KBZ Pay" class="w-12 h-12 object-contain mr-4">
            <span class="flex-1 font-medium">KBZ Pay</span>
            <span class="hidden group-has-[:checked]:inline-block text-black font-bold">✓</span>
        </label>

        <!-- Wave Pay -->
        <label class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-black group">
            <input type="radio" name="payment_method" value="wave_pay" class="sr-only">
            <img src="{{ asset('images/payments/wave.png') }}" alt="Wave Pay" class="w-12 h-12 object-contain mr-4">
            <span class="flex-1 font-medium">Wave Pay</span>
            <span class="hidden group-has-[:checked]:inline-block text-black font-bold">✓</span>
        </label>

        <!-- AYA Pay -->
        <label class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-black group">
            <input type="radio" name="payment_method" value="aya_pay" class="sr-only">
            <img src="{{ asset('images/payments/aya.png') }}" alt="AYA Pay" class="w-12 h-12 object-contain mr-4">
            <span class="flex-1 font-medium">AYA Pay</span>
            <span class="hidden group-has-[:checked]:inline-block text-black font-bold">✓</span>
        </label>

        <!-- Bank Transfer -->
        <label class="flex items-center p-4 border border-gray-200 rounded cursor-pointer hover:border-black group">
            <input type="radio" name="payment_method" value="bank" class="sr-only">
            <img src="{{ asset('images/payments/bank.png') }}" alt="Bank Transfer" class="w-12 h-12 object-contain mr-4">
            <span class="flex-1 font-medium">UAB Bank Transfer</span>
            <span class="hidden group-has-[:checked]:inline-block text-black font-bold">✓</span>
        </label>

        <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition w-full">
            Pay Now
        </button>
    </form>
@endsection
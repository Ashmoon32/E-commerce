@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-8">Checkout</h1>
    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
    <ul class="divide-y divide-gray-200 border border-gray-200 mb-6">
        @foreach($cartItems as $item)
            <li class="flex justify-between p-3">
                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </li>
        @endforeach
    </ul>
    <p class="text-xl font-light mb-6">Total: <span class="font-semibold">${{ number_format($total, 2) }}</span></p>
    <form action="{{ route('checkout.place') }}" method="POST" class="space-x-4">
        @csrf
        <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">Place
            Order</button>
        <a href="{{ route('cart.index') }}"
            class="border border-black px-6 py-2 text-sm hover:bg-black hover:text-white transition">Edit Cart</a>
    </form>
@endsection
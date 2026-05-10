@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-8">Checkout</h1>
    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

    <ul class="divide-y divide-gray-200 border border-gray-200 mb-6">
        @foreach($cartItems as $id => $item)
            <li class="flex flex-col sm:flex-row sm:items-center justify-between p-4 gap-3">
                <div class="flex-1">
                    <span class="font-medium">{{ $item['name'] }}</span>
                    <span class="text-sm text-gray-500 ml-2">x{{ $item['quantity'] }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="font-light">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    <div class="flex gap-2">
                        <!-- Update quantity form (quick adjust) -->
                        <form action="{{ route('cart.update') }}" method="POST" class="inline-flex items-center gap-1">
                            @csrf @method('PUT')
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                class="border border-gray-300 w-14 text-center px-1 py-1 text-sm">
                            <button type="submit"
                                class="text-xs bg-gray-200 px-2 py-1 rounded hover:bg-gray-300">Update</button>
                        </form>
                        <!-- Remove button -->
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded hover:bg-red-200">Remove</button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <p class="text-xl font-light mb-6">Total: <span class="font-semibold">${{ number_format($total, 2) }}</span></p>

    <div class="flex flex-wrap gap-3">
        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf
            <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">
                Place Order
            </button>
        </form>
        <a href="{{ route('cart.index') }}"
            class="border border-black px-6 py-2 text-sm hover:bg-black hover:text-white transition inline-block">
            Edit Cart
        </a>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-8">Shopping Cart</h1>
    @if(count($cartItems) == 0)
        <p class="text-gray-500">Your cart is empty.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-3 font-normal">Product</th>
                        <th class="text-left p-3 font-normal">Price</th>
                        <th class="text-left p-3 font-normal">Qty</th>
                        <th class="text-left p-3 font-normal">Subtotal</th>
                        <th class="p-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cartItems as $id => $item)
                        <tr>
                            <td class="p-3">{{ $item['name'] }}</td>
                            <td class="p-3">${{ number_format($item['price'], 2) }}</td>
                            <td class="p-3">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="product_id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                        class="border border-gray-300 w-16 text-center px-2 py-1">
                                    <button type="submit" class="text-xs underline hover:no-underline">Update</button>
                                </form>
                            </td>
                            <td class="p-3">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="p-3">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-sm underline hover:no-underline">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-50 font-semibold">
                        <td class="p-3" colspan="3">Total</td>
                        <td class="p-3" colspan="2">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex space-x-4">
            <a href="{{ route('checkout.index') }}"
                class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">Proceed to Checkout</a>
            <a href="{{ route('shop.index') }}"
                class="border border-black px-6 py-2 text-sm hover:bg-black hover:text-white transition">Continue Shopping</a>
        </div>
    @endif
@endsection
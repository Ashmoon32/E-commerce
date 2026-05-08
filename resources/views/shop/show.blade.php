@extends('layouts.app')

@section('content')
    <div class="max-w-3xl">
        <a href="{{ route('shop.index') }}" class="text-sm text-gray-500 hover:text-black mb-4 inline-block">&larr; Back to
            Shop</a>
        <h1 class="text-3xl font-light mb-2">{{ $product->name }}</h1>
        <p class="text-sm text-gray-500 mb-4">Category: {{ $product->category->name ?? 'None' }}</p>
        <p class="text-2xl font-light mb-4">${{ number_format($product->price, 2) }}</p>
        <p class="text-gray-700 mb-4">In Stock: <span class="font-semibold">{{ $product->stock }}</span></p>
        <p class="text-gray-600 mb-6">{{ $product->description }}</p>

        @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="flex items-center space-x-4 mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                    class="border border-gray-300 px-3 py-2 w-20 text-center">
                <button type="submit" class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">Add to
                    Cart</button>
            </form>
        @else
            <p class="text-red-600">Out of stock</p>
        @endif
    </div>
@endsection
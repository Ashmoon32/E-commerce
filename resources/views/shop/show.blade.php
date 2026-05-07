@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Category: {{ $product->category->name ?? 'None' }}</p>
    <p>Price: ${{ number_format($product->price, 2) }}</p>
    <p>In stock: {{  $product->stock }}</p>
    <p>{{ $product->description }}</p>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <label>Quantity: <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"></label>
        <button type="submit">Add to Cart</button>
    </form>
    <a href="{{ route('shop.index') }}">Back to Shop</a>
@endsection
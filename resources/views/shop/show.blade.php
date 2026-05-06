@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Category: {{ $product->category->name ?? 'None' }}</p>
    <p>Price: ${{ number_format($product->price, 2) }}</p>
    <p>In stock: {{  $product->stock }}</p>
    <p>{{ $product->description }}</p>
    <a href="{{ route('shop.index') }}">Back to Shop</a>
@endsection
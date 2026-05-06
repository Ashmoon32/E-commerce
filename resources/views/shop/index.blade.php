@extends('layouts.app')

@section('content')
    <h1>Our Products</h1>
    <div style="display: flex; flex-wrap: wrap; gap: 20px">
        @foreach ($products as $product)
            <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">
                <h3>{{  $product->name }}</h3>
                <p>{{ $product->category->name ?? 'No category' }}</p>
                <p>${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('shop.show', $product) }}">View details</a>
            </div>
        @endforeach
    </div>
    {{ $products->links() }}
@endsection
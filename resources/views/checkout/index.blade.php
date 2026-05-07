@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>
    <h3>Order Summary</h3>
    <ul>
        @foreach($cartItems as $item)
            <li>{{ $item['name'] }} x {{ $item['quantity'] }} = ${{ number_format($item['price'] * $item['quantity'], 2) }}</li>
        @endforeach
    </ul>
    <p><strong>Total: ${{ number_format($total, 2) }}</strong></p>
    <form action="{{ route('checkout.place') }}" method="POST">
        @csrf
        <button type="submit">Place Order</button>
    </form>
    <a href="{{ route('cart.index') }}">Edit Cart</a>
@endsection
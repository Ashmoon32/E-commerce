@extends('layouts.app')

@section('content')
    <h1>Shopping Cart</h1>
    @if(count($cartItems) == 0)
        <p>Your cart is empty.</p>
    @else
        <table border="1" cellpadding="5">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            @foreach($cartItems as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="product_id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" style="width:60px;">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>${{ number_format($total, 2) }}</strong></td>
            </tr>
        </table>
    @endif
    <br><a href="{{ route('shop.index') }}">Continue Shopping</a>
    <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
@endsection
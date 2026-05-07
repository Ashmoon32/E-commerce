@extends('layouts.app')

@section('content')
    <h1>Your Orders</h1>
    @foreach($orders as $order)
        <div>
            <a href="{{ route('orders.show', $order) }}">Order #{{ $order->id }}</a>
            - {{ $order->created_at->format('M d, Y') }}
            - ${{ number_format($order->total, 2) }}
            - <span>{{ $order->status }}</span>
        </div>
    @endforeach
@endsection
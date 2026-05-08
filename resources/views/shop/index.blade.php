@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-8">Our Products</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="border border-gray-200 p-4 bg-white hover:shadow-sm transition">
                <h3 class="font-semibold text-lg mb-1">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ $product->category->name ?? 'No category' }}</p>
                <p class="text-lg font-light mb-3">${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('shop.show', $product) }}"
                    class="inline-block border border-black px-4 py-1 text-sm hover:bg-black hover:text-white transition">View
                    Details</a>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection
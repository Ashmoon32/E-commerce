@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-light mb-8">Our Products</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="border border-gray-200 p-4 bg-white hover:shadow-sm transition">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-48 object-cover mb-2">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 mb-2">No Image</div>
                @endif
                <h3 class="font-semibold text-lg mb-1">{{ $product->name }}</h3>
                @if($product->stock == 0)
                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded mb-2">Sold Out</span>
                @else
                    <p class="text-sm text-gray-500 mb-2">{{ $product->category->name ?? 'No category' }}</p>
                    <p class="text-lg font-light mb-3">${{ number_format($product->price, 2) }}</p>
                @endif
                <a href="{{ route('shop.show', $product) }}"
                    class="inline-block border border-black px-4 py-1 text-sm hover:bg-black hover:text-white transition">
                    @if($product->stock == 0) View @else View Details @endif
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $products->links() }}
    </div>
@endsection
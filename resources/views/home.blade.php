@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="py-8">
        <h1 class="text-4xl font-light tracking-tight mb-4">Welcome to our Store</h1>
        <p class="text-lg text-gray-600 max-w-2xl mb-8">Curated products, minimal design, fair prices.</p>

        @if($popularProducts->count())
            <h2 class="text-2xl font-light mb-4">Popular Products</h2>
            <div class="relative" x-data="{ active: 0, items: {{ $popularProducts->count() }} }">
                <!-- Carousel container -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="'transform: translateX(-' + (active * 100) + '%)'">
                        @foreach($popularProducts as $product)
                            <div class="w-full flex-shrink-0 md:w-1/3 lg:w-1/4 px-2">
                                <a href="{{ route('shop.show', $product) }}"
                                    class="block border border-gray-200 p-2 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover" alt="">
                                    @else
                                        <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">No Image
                                        </div>
                                    @endif
                                    <h3 class="font-semibold mt-2 text-sm">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500">${{ number_format($product->price, 2) }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Prev/Next buttons -->
                <button @click="active = active === 0 ? items - 1 : active - 1"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow">
                    &lt;
                </button>
                <button @click="active = active === items - 1 ? 0 : active + 1"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow">
                    &gt;
                </button>
            </div>
        @endif
    </div>
@endsection
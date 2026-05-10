@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- HERO -->
    <section class="py-16 md:py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-light tracking-tight mb-4">Modern E‑Commerce Experience</h1>
        <p class="text-lg text-gray-600 max-w-xl mx-auto mb-8">
            Curated products, minimal design, fair prices – delivered to your door.
        </p>
        <a href="{{ route('shop.index') }}"
            class="inline-block bg-black text-white px-8 py-3 text-sm font-medium hover:bg-gray-800 transition">
            Shop Now
        </a>
    </section>

    <!-- SHOP BY CATEGORY (with dynamic product images) -->
    <section class="mb-16">
        <h2 class="text-2xl font-light mb-6">Shop by Category</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach($categories as $category)
                @php
                    $bestProduct = $categoryPopularProducts[$category->id] ?? null;
                @endphp
                <a href="{{ route('shop.index', ['search' => $category->name]) }}"
                    class="block border border-gray-200 hover:border-black hover:shadow-lg transition duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <div class="w-full h-40 sm:h-48 bg-gray-100 flex items-center justify-center">
                        @if($bestProduct && $bestProduct->image)
                            <img src="{{ $bestProduct->image }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400 text-sm">No Image</span>
                        @endif
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- POPULAR PRODUCTS (Carousel) -->
    @if($popularProducts->count())
        <section class="mb-16">
            <h2 class="text-2xl font-light mb-6">Popular Products</h2>
            <div class="relative" x-data="{ active: 0, items: {{ $popularProducts->count() }} }">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out"
                        :style="'transform: translateX(-' + (active * 100) + '%)'">
                        @foreach($popularProducts as $product)
                            <div class="w-full flex-shrink-0 md:w-1/3 lg:w-1/4 px-2">
                                <a href="{{ route('shop.show', $product) }}"
                                    class="block border border-gray-200 p-3 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center mb-2">
                                        @if($product->image)
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <span class="text-gray-400 text-sm">No Image</span>
                                        @endif
                                    </div>
                                    <h3 class="font-semibold mt-2 text-sm">{{ $product->name }}</h3>
                                    <p class="text-xs text-gray-500">${{ number_format($product->price, 2) }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <button @click="active = active === 0 ? items - 1 : active - 1"
                    class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow hover:bg-gray-50">
                    &#8592;
                </button>
                <button @click="active = active === items - 1 ? 0 : active + 1"
                    class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow hover:bg-gray-50">
                    &#8594;
                </button>
            </div>
        </section>
    @endif

    <!-- NEW ARRIVALS -->
    @if($latestProducts->count())
        <section class="mb-16">
            <h2 class="text-2xl font-light mb-6">New Arrivals</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($latestProducts as $product)
                    <a href="{{ route('shop.show', $product) }}"
                        class="block border border-gray-200 p-3 hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="w-full h-32 bg-gray-100 flex items-center justify-center mb-2">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-sm">No Image</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-sm">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-500">${{ number_format($product->price, 2) }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- TRUST BAR -->
    <section class="border-t border-b border-gray-200 py-8 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="space-y-2">
                <span class="text-3xl">🚚</span>
                <p class="font-semibold">Free Shipping</p>
                <p class="text-sm text-gray-500">On orders over $50</p>
            </div>
            <div class="space-y-2">
                <span class="text-3xl">🔒</span>
                <p class="font-semibold">Secure Payment</p>
                <p class="text-sm text-gray-500">100% secure transactions</p>
            </div>
            <div class="space-y-2">
                <span class="text-3xl">💬</span>
                <p class="font-semibold">24/7 Support</p>
                <p class="text-sm text-gray-500">We're here to help</p>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="text-center pb-12">
        <h2 class="text-2xl font-light mb-4">Ready to find your next favorite product?</h2>
        <a href="{{ route('shop.index') }}"
            class="inline-block bg-black text-white px-8 py-3 text-sm font-medium hover:bg-gray-800 transition">
            Explore All Products
        </a>
    </section>
@endsection
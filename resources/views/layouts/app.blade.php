<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Shop')</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-900 antialiased">
    <nav class="bg-black text-white p-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="space-x-6 text-sm">
                <a href="/" class="hover:text-gray-300 font-semibold">Home</a>
                <a href="/shop" class="hover:text-gray-300 font-semibold">Shop</a>
                <a href="{{ route('cart.index') }}" class="hover:text-gray-300 font-semibold">Cart
                    ({{ \App\Services\Cart::totalItems() }})</a>
            </div>
            <div class="space-x-4 text-sm">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                @endguest
                @auth
                    <span>Hello, {{ auth()->user()->name }}!</span>
                    <a href="{{ route('orders.index') }}" class="hover:text-gray-300">My Orders</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-300">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-gray-100 border border-gray-300 text-gray-800 px-4 py-3 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
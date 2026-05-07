<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'E-commerce')</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
    
        nav a {
            margin-right: 10px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav>
    <a href="/">Home</a>
    <a href="/shop">Shop</a>
    <a href="{{ route('cart.index') }}">Cart ({{ \App\Services\Cart::totalItems() }})</a>
    @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endguest
    @auth
        <span>Hello, {{ auth()->user()->name }}!</span>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
        <a href="{{ route('orders.index') }}">My Orders</a>
    @endauth
    </nav>
    <hr>
    <div>
        @yield('content')
    </div>
</body>
</html>
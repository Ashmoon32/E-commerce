<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('tilte', 'Admin')</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .alert {
            background: lightgreen;
            padding: 10px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="{{ route('admin.products.index') }}">Products</a>  |
        <a href="/">Home</a>  | 
        <a href="/about">About</a>  |
        <a href="/shop">Shop</a>  |
        <a href="/admin/products">Admin Panel</a>  |
    </nav>
    <hr>
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    @yield('content')
    
</body>
</html>
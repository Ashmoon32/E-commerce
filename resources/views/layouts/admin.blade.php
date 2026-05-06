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
</head>
<body>
    <h1>Admin Panel</h1>
    <nav>
        <a href="{{ route('admin.products.index') }}">Products</a>
    </nav>
    <hr>
    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif@yield('content')
    
</body>
</html>
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
</head>
<body>
    <nav>
        <a href="/">Home</a>
        <a href="/about">About</a>
    </nav>
    <hr>
    <div>
        @yield('content')
    </div>
</body>
</html>
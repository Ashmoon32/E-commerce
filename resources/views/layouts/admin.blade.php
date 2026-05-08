<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
    <nav class="bg-black text-white p-4">
        <div class="max-w-7xl mx-auto flex items-center space-x-6 text-sm">
            <a href="{{ route('admin.products.index') }}" class="hover:text-gray-300 font-semibold">Products</a>
            <a href="/" target="_blank" class="hover:text-gray-300 ml-auto">View Site</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-white border border-gray-300 px-4 py-3 mb-4 text-gray-800">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
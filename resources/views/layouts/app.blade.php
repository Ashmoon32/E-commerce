<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Shop')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-white text-gray-900 antialiased">

    <!-- Header with search and hamburger -->
    <header class="bg-black text-white" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Brand / Logo (optional) -->
            <a href="/" class="text-xl font-light tracking-wide">MyShop</a>

            <!-- Search bar (always visible) -->
            <form action="{{ route('shop.index') }}" method="GET" class="flex-1 mx-4 flex items-center">
                <input type="text" name="search" placeholder="Search products..."
                    class="w-full max-w-md px-3 py-1 text-sm text-gray-900 border border-gray-300 rounded focus:outline-none focus:border-black"
                    value="{{ request('search') }}">
                <button type="submit" class="ml-2 px-3 py-1 text-sm bg-gray-800 hover:bg-gray-700 rounded transition">
                    Search
                </button>
            </form>

            <!-- Mobile menu button (hamburger) -->
            <button @click="open = !open" class="lg:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation links (desktop always visible, mobile toggle) -->
        <nav :class="{'block': open, 'hidden': !open}" class="lg:block bg-gray-900 lg:bg-black">
            <div
                class="max-w-7xl mx-auto px-4 py-2 flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-2 lg:space-y-0">
                <!-- Left side links -->
                <div class="flex flex-col lg:flex-row space-y-2 lg:space-y-0 lg:space-x-6 text-sm">
                    <a href="/" class="hover:text-gray-300 font-semibold">Home</a>
                    <a href="/about" class="hover:text-gray-300 font-semibold">About</a>
                    <a href="/shop" class="hover:text-gray-300 font-semibold">Shop</a>
                    <a href="{{ route('cart.index') }}" class="hover:text-gray-300 font-semibold">
                        Cart ({{ \App\Services\Cart::totalItems() }})
                    </a>
                </div>

                <!-- Right side user links -->
                <div class="flex flex-col lg:flex-row space-y-2 lg:space-y-0 lg:space-x-4 text-sm mt-2 lg:mt-0">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                    @endguest
                    @auth
                        <span class="text-gray-300">Hello, {{ auth()->user()->name }}!</span>
                        <a href="{{ route('orders.index') }}" class="hover:text-gray-300">My Orders</a>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-300 font-semibold">Admin Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-gray-300">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto p-6">
        @if(session('success'))
            <div class="bg-gray-100 border border-gray-300 text-gray-800 px-4 py-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-300 text-red-800 px-4 py-3 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
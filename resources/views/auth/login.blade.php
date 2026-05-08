@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-3xl font-light mb-6">Login</h1>
        @if ($errors->any())
            <div class="bg-gray-100 border border-gray-300 text-gray-800 px-4 py-3 mb-4">
                {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
            <button type="submit"
                class="bg-black text-white px-6 py-2 w-full text-sm hover:bg-gray-800 transition">Login</button>
        </form>
        <p class="mt-4 text-sm text-gray-500">No account? <a href="{{ route('register') }}"
                class="underline hover:text-black">Register</a></p>
    </div>
@endsection
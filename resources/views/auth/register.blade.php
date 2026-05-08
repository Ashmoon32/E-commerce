@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10">
        <h1 class="text-3xl font-light mb-6">Register</h1>
        @if ($errors->any())
            <div class="bg-gray-100 border border-gray-300 text-gray-800 px-4 py-3 mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" required
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
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
            <div>
                <label class="block text-sm font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:border-black">
            </div>
            <button type="submit"
                class="bg-black text-white px-6 py-2 w-full text-sm hover:bg-gray-800 transition">Register</button>
        </form>
        <p class="mt-4 text-sm text-gray-500">Already have an account? <a href="{{ route('login') }}"
                class="underline hover:text-black">Login</a></p>
    </div>
@endsection
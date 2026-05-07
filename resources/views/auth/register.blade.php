@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div style="background: #ffe6e6; padding: 10px; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: #cc0000;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label>Name: <input type="text" name="name" required></label><br>
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Password: <input type="password" name="password" required></label><br>
            <label>Confirm Password: <input type="password" name="password_confirmation" required></label><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
@endsection
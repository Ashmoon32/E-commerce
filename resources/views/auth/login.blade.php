@extends('layouts.app')

@section('content')
    <h1>Login</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
    </form>
    <p>No account? <a href="{{ route('register') }}">Register</a></p>
    @if($errors->any())
        <p style="color:red;">{{ $errors->first() }}</p>
    @endif
@endsection
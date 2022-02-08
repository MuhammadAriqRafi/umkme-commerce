@extends('layout.guest')

@section('content')
    <h1>Login</h1>

    @if(session()->has('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="/" method="POST">
        @csrf
        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email" autofocus required value="{{ old('email') }}">
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="text" name="password" required>
        </div>
        <button type="submit">Login</button>
        <a href="/forgot-password">Lupa password?</a>
    </form>
@endsection
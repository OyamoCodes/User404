@extends('layouts.xp')

@section('content')
<div class="login-box">
    <h2>Bem-vindo</h2>

    @if (session('status'))
    <div style="color: green; font-size: 14px; margin-bottom: 10px;">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <div style="text-align: center; margin-top: 15px;">
            <button type="submit" class="btn">Entrar</button>
        </div>
    </form>

    <div class="guest" style="margin-top: 20px; text-align: center;">
        <a href="/game" style="color: #174db2; text-decoration: none; user-select: none;">Entrar como convidado</a>
    </div>
</div>
@endsection

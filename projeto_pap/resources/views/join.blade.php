@extends('layouts.public')

@section('content')
<div class="container py-5 text-center">
    <h2 class="text-xl font-bold mb-4">Entrar num Jogo</h2>

    @if(session('error'))
        <div class="alert alert-danger mb-3">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('game.enter') }}" class="mx-auto" style="max-width: 300px;">
        @csrf
        <input type="text" name="codigo" class="form-control text-center mb-3" placeholder="Código do Jogo" required />

        <button type="submit" class="btn btn-primary w-100">
            Entrar
        </button>
    </form>
</div>
@endsection

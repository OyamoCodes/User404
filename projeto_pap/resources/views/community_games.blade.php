@extends('layouts.public')

@section('title', 'Jogos da Comunidade')

@section('content')
<h1 class="mb-4 fw-bold" style="color:#5a3ea1;">Jogos da Comunidade</h1>

<form method="GET" action="{{ route('jogos.community_index') }}" role="search" aria-label="Pesquisar jogos públicos" class="mb-5 d-flex gap-2 flex-wrap">
    <input type="search" id="searchInput" name="q" placeholder="Pesquisar por nome, escola ou #tags..."
        aria-label="Pesquisar jogos" value="{{ old('q', $searchQuery ?? '') }}"
        class="form-control flex-grow-1" style="min-width: 220px; max-width: 400px;" />
    <button type="submit" aria-label="Pesquisar" class="btn btn-primary px-4">
        <i class="bi bi-search"></i> Pesquisar
    </button>
</form>

@if ($games->isEmpty())
    <div class="alert alert-warning" role="alert" aria-live="polite" style="max-width: 480px;">
        Nenhum jogo encontrado para a pesquisa.
    </div>
@else
<section class="cards-grid" role="list" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1.8rem;">
    @foreach ($games as $game)
        @php
            preg_match_all('/#\w+/u', $game->description, $matches);
            $tags = $matches[0];
        @endphp
        <article class="card-game bg-white rounded-3 p-4 shadow-sm d-flex flex-column justify-content-between" role="listitem" tabindex="0"
            aria-label="Jogo {{ $game->title }} da escola {{ $game->school }}"
            style="transition: transform 0.2s ease, box-shadow 0.2s ease;">
            <div>
                <h3 class="h5 fw-semibold" style="color:#5a3ea1;">{{ $game->title }}</h3>
                <div class="school text-muted mb-2 fst-italic">{{ $game->school }}</div>
                <p class="description text-secondary" style="min-height: 60px; overflow-wrap: break-word;">{{ $game->description }}</p>
            </div>

            <div class="tags mb-3" aria-label="Tags do jogo">
                @foreach ($tags as $tag)
                    <span class="badge rounded-pill text-bg-secondary me-1" style="font-size: 0.85rem;">{{ $tag }}</span>
                @endforeach
            </div>

            <a href="{{ $game->link }}" class="btn btn-outline-primary align-self-start" target="_blank" rel="noopener noreferrer"
                aria-label="Jogar {{ $game->title }}">
                <i class="bi bi-play-fill"></i> Jogar
            </a>
        </article>
    @endforeach
</section>
@endif

<script>
    // Pequeno efeito hover nos cards (sem usar CSS inline)
    document.querySelectorAll('.card-game').forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-6px)';
            card.style.boxShadow = '0 12px 28px rgba(90, 62, 161, 0.3)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'none';
            card.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
        });
    });
</script>
@endsection

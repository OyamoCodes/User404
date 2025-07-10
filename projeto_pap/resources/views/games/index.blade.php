<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meus Jogos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($games->isEmpty())
                <p class="text-gray-600 dark:text-gray-300">Ainda não criaste nenhum jogo. </p>
                <a href="{{ route('games.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                    Criar novo jogo
                </a>

                @else
                <div class="space-y-4">
                    @foreach($games as $game)
                    <div class="game-card bg-white dark:bg-gray-700 rounded-xl shadow p-4 flex flex-col">

                        <div class="game-header flex justify-between items-center cursor-pointer">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">{{ $game->title }}</h3>
                            <button class="toggle-btn text-gray-600 dark:text-gray-300 focus:outline-none transition-transform duration-300">
                                <!-- Seta para a direita -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <div class="game-details mt-3 text-gray-700 dark:text-gray-300 space-y-1">
                            @if($game->school)
                            <p><strong>Escola:</strong> {{ $game->school }}</p>
                            @endif
                            <p><strong>Código:</strong> {{ $game->code }}</p>

                            <div class="mt-3 flex space-x-4">
                                <a href="{{ route('games.show', $game->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Ver</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gameCards = document.querySelectorAll('.game-card');

            gameCards.forEach(card => {
                const header = card.querySelector('.game-header');
                const details = card.querySelector('.game-details');
                const toggleBtn = card.querySelector('.toggle-btn');
                let open = true;

                // Inicialmente detalhes visíveis (open = true)
                details.style.display = 'block';

                header.addEventListener('click', () => {
                    open = !open;
                    if (open) {
                        details.style.display = 'block';
                        toggleBtn.style.transform = 'rotate(90deg)';
                    } else {
                        details.style.display = 'none';
                        toggleBtn.style.transform = 'rotate(0deg)';
                    }
                });

                // Inicializar estado da seta para rodar 90 graus
                toggleBtn.style.transform = 'rotate(90deg)';
            });
        });
    </script>
</x-app-layout>
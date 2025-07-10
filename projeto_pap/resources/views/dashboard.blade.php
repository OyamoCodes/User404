<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Bem vindo/a, <br>{{ Auth::user()->name }}!</h1><br>
                    Este é o seu dashboard, onde pode gerir os seus jogos e aceder a outras funcionalidades.<br>
                </div>
                <div class=" p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <a href="{{ route('games.create') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Criar um jogo novo</h3>
                        <p class="text-gray-600 dark:text-gray-300">Cria um jogo personalizado por <br> si!</p>
                    </a>
                    <a href="{{ route('welcome') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Pagina Principal</h3>
                        <p class="text-gray-600 dark:text-gray-300">Volta para a página principal.</p>
                    </a>
                    <a href="{{ route('games.index') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Ver Todos os jogos</h3>
                        <p class="text-gray-600 dark:text-gray-300">Veja a lista de todos os seus jogos.</p>
                    </a>
                </div>
                <hr class="my-6 border-gray-300 dark:border-gray-600" />
                @if($games->isNotEmpty())
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($games as $game)
                    <div class="bg-white dark:bg-gray-700 rounded-xl shadow p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $game->title }}</h3>
                            @if ($game->status == 1)
                            <span class="text-gray-600 dark:text-gray-300 mb-1">
                                <i class="fa-solid fa-eye"></i> Público
                            </span>
                            @else
                            <span class="text-gray-600 dark:text-gray-300 mb-1">
                                <i class="fa-solid fa-eye-slash"></i> Privado
                            </span>
                            @endif

                            @if($game->school)
                            <p class="text-gray-600 dark:text-gray-300 mb-1"><strong>Escola:</strong> {{ $game->school }}</p>
                            @endif
                            @if($game->description)
                            <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $game->description }}</p>
                            @endif
                        </div>

                        <div class="mt-auto flex space-x-4 pt-4">
                            <a href="{{ route('games.show', $game->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Ver Informações</a>
                            <a href="{{ route('levels.index', $game->id) }}" class="text-green-600 dark:text-green-400 hover:underline"><i class="fa-regular fa-pen-to-square"></i> Costumizar</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
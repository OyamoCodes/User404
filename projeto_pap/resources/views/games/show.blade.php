<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Jogo: {{ $game->title }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 p-6 rounded shadow">
        {{-- INFO DO JOGO --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Informações do Jogo</h3>
            <a href="{{ route('games.edit', $game->id) }}" class="text-green-600 dark:text-green-400 hover:underline"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
            <form action="{{ route('games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Tens a certeza que queres eliminar este jogo?')" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline bg-transparent border-0 p-0 cursor-pointer">
                    <i class="fa-regular fa-trash-can"></i> Eliminar
                </button>
            </form>
            <p><strong>Título:</strong> {{ $game->title }}</p>
            <p><strong>Escola:</strong> {{ $game->school ?? '-' }}</p>
            <p><strong>Descrição:</strong> {{ $game->description ?? '-' }}</p>
            <p>
                <strong>Código:</strong>
                <span id="codeDisplay" class="font-mono tracking-wider">****</span>
                <button onclick="toggleCode(event)" class="ml-3 text-sm bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold py-1 px-2 rounded">
                    Mostrar
                </button>
            </p>
        </div>
        <hr class="my-6 border-gray-300 dark:border-gray-600" />

        <a href="{{ route('play', $game->id) }}"
            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            <i class="fa-solid fa-play mr-2"></i> Jogar "{{ $game->title }}"
        </a>


        {{-- NÍVEIS DO JOGO --}}
        <div class="mt-8">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-3">Níveis do Jogo</h3>
            @if($game->levels && $game->levels->count())
            <div class="space-y-4">
                @foreach($game->levels as $level)
                <div class="p-4 border rounded bg-gray-50 dark:bg-gray-700">
                    <p class="text-white"><strong>Nome:</strong> {{ $level->theme }}</p>
                    <p class="text-white"><strong>Template:</strong> {{ $level->template->name ?? 'Sem template' }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-400 italic">Este jogo ainda não tem níveis.</p>

            <a href="{{ route('levels.index', $game->id) }}" class="text-green-600 dark:text-green-400 hover:underline"><i class="fa-regular fa-pen-to-square"></i>Criar um nivel</a>
            @endif
        </div>
    </div>
    <script>
        function toggleCode(event) {
            event.preventDefault();
            const codeDisplay = document.getElementById('codeDisplay');
            if (codeDisplay.textContent === '****') {
                codeDisplay.textContent = '{{ $game->code ?? "N/A" }}';
                event.target.textContent = 'Esconder';
            } else {
                codeDisplay.textContent = '****';
                event.target.textContent = 'Mostrar';
            }
        }
    </script>

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Editar Jogo: {{ $game->title }}</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white dark:bg-gray-800 p-6 rounded shadow">

        {{-- INFO DO JOGO --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300">Informações do Jogo</h3>
            <p><strong>Título:</strong> {{ $game->title }}</p>
            <p><strong>Escola:</strong> {{ $game->school ?? '-' }}</p>
            <p>
                    <strong>Código:</strong>
                    <span id="codeDisplay" class="font-mono tracking-wider">****</span>
                    <button onclick="toggleCode(event)" class="ml-3 text-sm bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold py-1 px-2 rounded">
                        Mostrar
                    </button>
                </p>
        </div>

        {{-- LISTA DE NÍVEIS --}}
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">Níveis Criados</h3>

            @if($game->levels->count())
            <ul class="space-y-3">
                @foreach($game->levels as $level)
                <li class="p-3 bg-gray-100 dark:bg-gray-700 rounded shadow">
                    <p><strong>Título:</strong> {{ $level->theme }}</p>
                    <p><strong>Template:</strong> {{ $level->template->name }}</p>
                    <p><strong>Inputs:</strong> {{ json_encode($level->input_expected) }}</p>
                    <p><strong>Outputs:</strong> {{ json_encode($level->output_expected) }}</p>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-600 dark:text-gray-400">Ainda não existem níveis neste jogo.</p>
            @endif
        </div>

        {{-- BOTÃO ADICIONAR NÍVEL --}}
        <div class="text-right">
            <a href="{{ route('games.level_create', $game->id) }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Adicionar Nível
            </a>
        </div>

    </div>

    <script>
        const actualCode = @json($game -> code);

        function toggleCode(event) {
            const codeDisplay = document.getElementById('codeDisplay');
            const button = event.target;

            if (codeDisplay.textContent === '****') {
                codeDisplay.textContent = actualCode;
                button.textContent = 'Esconder';
            } else {
                codeDisplay.textContent = '****';
                button.textContent = 'Mostrar';
            }
        }
    </script>

</x-app-layout>
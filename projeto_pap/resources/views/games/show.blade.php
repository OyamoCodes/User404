<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $game->name }} - Detalhes do Jogo
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-100">Informações do Jogo</h3>
                <p><strong>Nome:</strong> {{ $game->name }}</p>
                <p><strong>Escola:</strong> {{ $game->school ?? 'N/A' }}</p>
                <p>
                    <strong>Código:</strong>
                    <span id="codeDisplay" class="font-mono tracking-wider">****</span>
                    <button onclick="toggleCode(event)" class="ml-3 text-sm bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold py-1 px-2 rounded">
                        Mostrar
                    </button>
                </p>

            </div>

            {{-- Lista de Níveis 
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Níveis</h3>
                    <a href="{{ route('levels.create', $game->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Adicionar Nível
                    </a>
                </div>

                @if ($game->levels->count() > 0)
                <table class="w-full table-auto text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                            <th class="p-2 border">Título</th>
                            <th class="p-2 border">Input Esperado</th>
                            <th class="p-2 border">Output Esperado</th>
                            <th class="p-2 border">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($game->levels as $level)
                        <tr class="border-b dark:border-gray-600">
                            <td class="p-2">{{ $level->title }}</td>
                            <td class="p-2">{{ $level->input_expected }}</td>
                            <td class="p-2">{{ $level->output_expected }}</td>
                            <td class="p-2 space-x-2">
                                <a href="{{ route('levels.edit', $level->id) }}"
                                    class="text-blue-600 hover:underline">Editar</a>
                                <form action="{{ route('levels.destroy', $level->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Tens a certeza que queres apagar este nível?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Apagar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-gray-600 dark:text-gray-300">Este jogo ainda não tem níveis.</p>
                @endif
            </div>--}}
        </div>
    </div>
<script>
    const actualCode = @json($game->code);

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

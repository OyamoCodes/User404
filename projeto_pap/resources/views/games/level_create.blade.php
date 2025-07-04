<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Criar Nível para: {{ $game->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded shadow">
        <form action="{{ route('games.level_store', $game->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Template</label>
                <select name="template_id" id="template-selector" class="w-full rounded p-2 mt-1" required>
                    <option value="">-- Escolher --</option>
                    @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Título do Nível</label>
                <input type="text" name="title" class="w-full rounded p-2 mt-1" required>
            </div>

            <div id="template-fields"></div>

            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Criar Nível
            </button>
        </form>
    </div>

    <script>
        const templateFields = document.getElementById('template-fields');
        const selector = document.getElementById('template-selector');

        selector.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex].text;

            templateFields.innerHTML = '';

            if (selected === 'programacao') {
                templateFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Pergunta do NPC</label>
                        <input type="text" name="input_expected[pergunta]" placeholder= "ex: " class="w-full rounded p-2 mt-1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Resposta esperada</label>
                        <input type="text" name="output_expected[resposta]" placeholder="" class="w-full rounded p-2 mt-1">
                    </div>
                `;
            } else if (selected === 'hardware') {
                templateFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Minijogos incluídos</label>
                        <label><input type="checkbox" name="input_expected[minijogos][]" value="montar_pc"> Montar PC</label><br>
                        <label><input type="checkbox" name="input_expected[minijogos][]"value="quiz_componentes"> Quiz de Componentes</label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Mensagem Final</label>
                        <input type="text" name="output_expected[mensagem]" placeholder:"ex:" class="w-full rounded p-2 mt-1">
                    </div>
                `;
            }
        });
    </script>
</x-app-layout>
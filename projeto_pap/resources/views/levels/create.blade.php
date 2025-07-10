<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Criar Nível para: {{ $game->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white dark:bg-gray-800 rounded shadow">
        <form action="{{ route('levels.create', $game->id) }}" method="POST">
            @csrf

            <!-- Título do Nível -->
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300 flex items-center justify-between">
                    Título do Nível
                    <button type="button" id="open-sidebar" class="ml-2 mb-2 px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                        Ver Instruções
                    </button>
                </label>

                <input type="text" name="title" placeholder="Ex: Nivel 1 - hello world" class="w-full rounded p-2 mt-1" required>
            </div>

            <!-- Selecionar Template -->
            <div class="mb-4">
                <label class="block text-gray-700 dark:text-gray-300">Template</label>
                <select name="template_id" id="template-selector" class="w-full rounded p-2 mt-1" required>
                    <option value="">-- Escolher --</option>
                    @foreach ($templates as $template)
                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Campos Específicos por Template -->
            <div id="template-fields"></div>

            <!-- Falas do Guia -->
            <div id="dialogues-section" class="mb-4 hidden">
                <label class="block text-gray-700 dark:text-gray-300">Falas do Guia</label>
                <div id="guide-messages-container"></div>
                <button type="button" id="add-message" class="mt-2 px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                    + Adicionar Fala
                </button>
            </div>

            <!-- Botão de Submissão -->
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Criar Nível
            </button>
        </form>
    </div>
    <!-- Sidebar Lateral -->
    <div id="sidebar-popup" class="fixed top-0 right-0 w-80 h-full bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 shadow-lg transform translate-x-full transition-transform duration-300 z-50">
        <div class="p-4 flex justify-between items-center border-b border-gray-300 dark:border-gray-700">
            <h3 class="text-lg font-semibold">Instruções do Nível</h3>
            <button id="close-sidebar" class="text-gray-500 hover:text-red-600 text-xl">&times;</button>
        </div>
        <div class="p-4 overflow-y-auto">
            <p>Usa este formulário para criar níveis personalizados com falas, minijogos e respostas interativas.</p>
            <ul class="mt-3 list-disc list-inside text-sm">
                <li>No "Título do Nível" mete um nome que te ajude a identificar depois!</li>
                <li>Escolhe um template para ser a base deste nivel.</li>
                <li>A fala do guia é o que vai aparecer para o aluno seguir.</li>
                <li>Se quer continuar a explicar mais com o guia, escolhe a opção NÃO no "Espera resposta" e crie mais falas!</li>
                <li>Quando quiser uma resposta do aluno, escolhe a opção SIM no "Espera resposta"</li>
                <li></li>
            </ul>
            <p>PROGRAMAÇÃO</p>
            <ul class="mt-3 list-disc list-inside text-sm">
                <li>A fala do guia é o que vai aparecer para o aluno seguir.</li>
                <li>Se quer continuar a explicar mais com o guia, escolhe a opção NÃO no "Espera resposta" e crie mais falas!</li>
                <li>Quando quiser uma resposta do aluno, escolhe a opção SIM no "Espera resposta"</li>
                <li>A resposta esperada é o que estás á espera que o aluno escreva, neste caso relacionado com o que o guia explicou.</li>
                <li>A resposta correta é o que o NPC vai responder após o aluno escrever o que foi pedido bem.</li>
                <li>A resposta incorreta é o que o NPC vai responder caso o aluno escrever o que foi pedido mal. </li>
                <p>!! O jogo só continua quando o aluno inserir a resposta certa !!</p>
            </ul>
        </div>
    </div>

    <script>
        const templateFields = document.getElementById('template-fields');
        const selector = document.getElementById('template-selector');
        const dialogueSection = document.getElementById('dialogues-section');
        const guideMessagesContainer = document.getElementById('guide-messages-container');
        const addMessageButton = document.getElementById('add-message');
        let messageIndex = 0;

        selector.addEventListener('change', function() {
            const selectedText = this.options[this.selectedIndex].text.toLowerCase();

            templateFields.innerHTML = '';
            dialogueSection.classList.add('hidden');

            if (selectedText === 'programacao') {
                dialogueSection.classList.remove('hidden'); // Mostrar falas do guia
                // Não mostrar campos específicos para programação além das falas

            } else if (selectedText === 'hardware') {
                // Mostrar campos específicos hardware e esconder falas
                templateFields.innerHTML = `
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Minijogos incluídos</label>
                        <label><input type="checkbox" name="input_expected[minijogos][]" value="montar_pc"> Montar PC</label><br>
                        <label><input type="checkbox" name="input_expected[minijogos][]" value="quiz_componentes"> Quiz de Componentes</label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300">Mensagem Final</label>
                        <input type="text" name="output_expected[mensagem]" placeholder="ex: Parabéns!" class="w-full rounded p-2 mt-1">
                    </div>
                `;
                dialogueSection.classList.add('hidden');

            } else {
                // Outros templates nada
                dialogueSection.classList.add('hidden');
                templateFields.innerHTML = '';
            }
        });

        addMessageButton.addEventListener('click', () => {
            const messageBlock = document.createElement('div');
            messageBlock.classList.add('mb-4', 'border', 'border-gray-300', 'rounded', 'p-4', 'bg-gray-100', 'dark:bg-gray-700', 'relative', 'message-block');
            messageBlock.innerHTML = `
                <label class="block text-gray-700 dark:text-gray-300 mb-1">Texto da Fala</label>
                <input type="text" name="dialogues[${messageIndex}][text]" placeholder="Texto do guia" class="w-full rounded p-2 mb-2" required>

                <input type="hidden" name="dialogues[${messageIndex}][speaker]" value="guide">

                <label class="block text-gray-700 dark:text-gray-300 mb-1">Esperar resposta do jogador?</label>
                <select name="dialogues[${messageIndex}][wait_for_input]" class="w-full rounded p-2 mb-2 wait-for-input">
                    <option value="0" selected>Não</option>
                    <option value="1">Sim</option>
                </select>

                <div class="conditional-inputs hidden">
                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Resposta esperada</label>
                    <input type="text" name="dialogues[${messageIndex}][expected_input]" placeholder='Ex: printf("Hello");' class="w-full rounded p-2 mb-2">

                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Resposta correta do NPC</label>
                    <input type="text" name="dialogues[${messageIndex}][correct_response_text]" placeholder="Ex: Parabéns!" class="w-full rounded p-2 mb-2">
                    <input type="hidden" name="dialogues[${messageIndex}][correct_response_speaker]" value="npc">

                    <label class="block text-gray-700 dark:text-gray-300 mb-1">Resposta incorreta do NPC</label>
                    <input type="text" name="dialogues[${messageIndex}][wrong_response_text]" placeholder="Ex: Tenta outra vez!" class="w-full rounded p-2 mb-2">
                    <input type="hidden" name="dialogues[${messageIndex}][wrong_response_speaker]" value="npc">
                </div>

                <div class="flex justify-between items-center mt-2">
                    <div>
                        <button type="button" class="move-up px-2 py-1 text-gray-600 hover:text-gray-900" title="Mover para cima" style="font-weight: bold; font-size: 20px;">▲</button>
                        <button type="button" class="move-down px-2 py-1 text-gray-600 hover:text-gray-900" title="Mover para baixo" style="font-weight: bold; font-size: 20px;">▼</button>
                    </div>
                    <button type="button" class="remove-message text-red-500 hover:text-red-700">✖</button>
                </div>
            `;
            guideMessagesContainer.appendChild(messageBlock);

            const waitSelect = messageBlock.querySelector('.wait-for-input');
            const conditionalInputs = messageBlock.querySelector('.conditional-inputs');

            waitSelect.addEventListener('change', () => {
                if (waitSelect.value === '1') {
                    conditionalInputs.classList.remove('hidden');
                    conditionalInputs.querySelectorAll('input').forEach(input => {
                        input.required = true;
                    });
                } else {
                    conditionalInputs.classList.add('hidden');
                    conditionalInputs.querySelectorAll('input').forEach(input => {
                        input.required = false;
                        input.value = '';
                    });
                }
            });

            conditionalInputs.classList.add('hidden');

            messageBlock.querySelector('.remove-message').addEventListener('click', () => {
                messageBlock.remove();
                updateOrderInputs();
            });

            messageBlock.querySelector('.move-up').addEventListener('click', () => {
                const prev = messageBlock.previousElementSibling;
                if (prev) {
                    guideMessagesContainer.insertBefore(messageBlock, prev);
                    updateOrderInputs();
                }
            });

            messageBlock.querySelector('.move-down').addEventListener('click', () => {
                const next = messageBlock.nextElementSibling;
                if (next) {
                    guideMessagesContainer.insertBefore(next, messageBlock);
                    updateOrderInputs();
                }
            });

            updateOrderInputs();

            messageIndex++;
        });

        // Função para atualizar os índices e os nomes do input order_in_game em cada fala
        function updateOrderInputs() {
            const messages = guideMessagesContainer.querySelectorAll('.message-block');
            messages.forEach((msg, index) => {
                // Atualizar o campo order_in_game (campo hidden)
                let orderInput = msg.querySelector('input[name*="[order_in_game]"]');
                if (!orderInput) {
                    // Se não existir, criar um campo hidden para a ordem
                    orderInput = document.createElement('input');
                    orderInput.type = 'hidden';
                    orderInput.name = `dialogues[${index}][order_in_game]`;
                    msg.appendChild(orderInput);
                }
                orderInput.value = index + 1;

                // Também atualizar os nomes dos inputs para manter a ordem correta no backend
                msg.querySelectorAll('input, select').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        // Substituir o índice no name pelo atual
                        const newName = name.replace(/dialogues\[\d+\]/, `dialogues[${index}]`);
                        input.setAttribute('name', newName);
                    }
                });
            });
        }
        // Abrir e fechar o sidebar lateral
        document.getElementById('open-sidebar').addEventListener('click', () => {
            document.getElementById('sidebar-popup').classList.remove('translate-x-full');
        });

        document.getElementById('close-sidebar').addEventListener('click', () => {
            document.getElementById('sidebar-popup').classList.add('translate-x-full');
        });
    </script>

</x-app-layout>
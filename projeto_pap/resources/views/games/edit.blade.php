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
            <p><strong>Descrição:</strong> {{ $game->description ?? '-' }}</p>
            <p>
                <strong>Código:</strong>
                <span id="codeDisplay" class="font-mono tracking-wider">****</span>
                <button onclick="toggleCode(event)" class="ml-3 text-sm bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100 font-semibold py-1 px-2 rounded">
                    Mostrar
                </button>
            </p>
            <form action="{{ route('games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Tens a certeza que queres eliminar este jogo?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>

        </div>

        <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- TÍTULO --}}
            <div>
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-semibold">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}" class="w-full mt-1 p-2 border rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            {{-- ESCOLA --}}
            <div>
                <label for="school" class="block text-gray-700 dark:text-gray-300 font-semibold">Escola (opcional)</label>
                <input type="text" name="school" id="school" value="{{ old('school', $game->school) }}" class="w-full mt-1 p-2 border rounded bg-gray-100 dark:bg-gray-700 dark:text-white">
            </div>

            {{-- DESCRIÇÃO --}}
            <div>
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-semibold">Descrição</label>
                <textarea name="description" id="description" rows="4" class="w-full mt-1 p-2 border rounded bg-gray-100 dark:bg-gray-700 dark:text-white">{{ old('description', $game->description) }}</textarea>
            </div>
            
            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Visibilidade</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Público</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Privado</option>
                </select>
                @error('status')
                <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            {{-- AÇÕES --}}
            <div class="flex justify-end space-x-3">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Guardar
                </button>

                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 flex items-center justify-center">
                    Cancelar
                </a>
            </div>
        </form>

        {{-- NÍVEIS DO JOGO --}}
        <div class="mt-8">
            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-3">Níveis do Jogo</h3>
            @if($game->levels && $game->levels->count())
            <div class="space-y-4">
                @foreach($game->levels as $level)
                <div class="p-4 border rounded bg-gray-50 dark:bg-gray-700">
                    <p class="text-white"><strong>Nome:</strong> {{ $level->name }}</p>
                    <p class="text-white"><strong>Dificuldade:</strong> {{ $level->difficulty }}</p>
                    <p class="text-white"><strong>Template:</strong> {{ $level->template->name ?? 'Sem template' }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-400 italic">Este jogo ainda não tem níveis.</p>
            @endif
        </div>
    </div>

    {{-- Toastr CSS e JS --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
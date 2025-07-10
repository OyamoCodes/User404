<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Criar Jogo
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <form method="POST" action="{{ route('games.store') }}">
                @csrf

                <!-- Nome do Jogo -->
                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nome do Jogo</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ old('title') }}" required>
                    @error('title')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Escola -->
                <div class="mb-4">
                    <label for="school" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Escola (opcional)</label>
                    <input type="text" name="school" id="school" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ old('school') }}">
                    @error('school')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Código -->
                <div class="mb-4">
                    <label for="code" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Código Único</label>
                    <input type="text" name="code" id="code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ old('code') }}" required>
                    @error('code')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Visibilidade -->
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


                <!-- Imagem
                <div class="mb-4">
                    <label for="imagem" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Imagem (URL ou caminho)</label>
                    <input type="text" name="imagem" id="imagem" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        value="{{ old('imagem') }}">
                    @error('imagem')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div> -->

                <!-- Descrição -->
                <div class="mb-4">
                    <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Descrição</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                    @error('description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <x-primary-button>
                        Criar Jogo
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
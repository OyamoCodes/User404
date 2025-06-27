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

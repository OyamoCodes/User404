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
                    Um texto qualquer
                </div>
                <div class=" p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <a href="{{ route('dashboard') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Go to Dashboard</h3>
                        <p class="text-gray-600 dark:text-gray-300">Return to the main dashboard overview.</p>
                    </a>
                    <a href="{{ route('dashboard') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Go to Dashboard</h3>
                        <p class="text-gray-600 dark:text-gray-300">Return to the main dashboard overview.</p>
                    </a>
                    <a href="{{ route('dashboard') }}" class="block p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-md transition">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-2">Go to Dashboard</h3>
                        <p class="text-gray-600 dark:text-gray-300">Return to the main dashboard overview.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
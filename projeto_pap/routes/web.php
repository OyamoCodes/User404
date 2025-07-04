<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/game', function () {
    return response()->file(public_path('jogo/index.html'));
});

Route::get('/dashboard', function () {
    $games = Auth::user()->games;
    return view('dashboard', compact('games'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/painel', function () {
        return view('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::get('/games/{game}/levels/new', [LevelController::class, 'create'])->name('games.level_create');
   Route::post('/games/{game}/levels', [LevelController::class, 'store'])->name('games.level_store');
});

require __DIR__ . '/auth.php';

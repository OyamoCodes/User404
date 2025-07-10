<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/game', function () {
    return response()->file(public_path('jogo/index.html'));
});

Route::get('/dashboard', function () {
    $games = Auth::user()->games;
    return view('dashboard', compact('games'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/play/{game}', [GameController::class, 'play'])->name('play');
Route::get('/join', function () {
    return view('join');
})->name('game.code_form');
Route::post('/entrar-jogo', [GameController::class, 'enterGame'])->name('game.enter');
Route::get('/community_games', [GameController::class, 'community_index'])->name('jogos.community_index');
Route::get('/teste/{id}', [GameController::class, 'testeConfigJson']);
Route::get('/sobre', function () {
    return view('about');
})->name('about');


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
    Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');
    Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::post('/games/{game}/update', [GameController::class, 'update'])->name('games.update');
    Route::get('/games/{game}/levels/', [LevelController::class, 'index'])->name('levels.index');
    Route::get('/games/{game}/levels/new', [LevelController::class, 'create'])->name('levels.create');
    Route::post('/games/{game}/levels/new', [LevelController::class, 'store'])->name('levels.update');
});

require __DIR__ . '/auth.php';

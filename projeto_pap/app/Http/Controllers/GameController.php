<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'code' => 'required|string|max:50|unique:games,code',
        ]);

        Game::create([
            'title' => $request->title,
            'school' => $request->school,
            'code' => $request->code,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Jogo criado com sucesso!');
    }

    public function show($id)
    {
        $game = Game::with('levels')->findOrFail($id);
        return view('games.show', compact('game'));
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'code' => 'required|string|max:50|unique:games,code,' . $game->id,
        ]);

        $game->update($request->only('title', 'school', 'code'));

        return redirect()->route('games.show', $game->id)->with('success', 'Game updated successfully!');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Level;
use App\Models\Template;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function create(Game $game)
    {
        $templates = Template::all();

        return view('games.level_create', compact('game', 'templates'));
    }

    public function store(Request $request, Game $game)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'theme' => 'required|string|max:255',
            'input_expected' => 'nullable|array',
            'output_expected' => 'nullable|array',
        ]);

        Level::create([
            'game_id' => $game->id,
            'template_id' => $request->template_id,
            'theme' => $request->theme,
            'input_expected' => $request->input_expected,
            'output_expected' => $request->output_expected,
        ]);

        return redirect()->route('games.show', $game->id)
            ->with('success', 'Nível criado com sucesso!');
    }
}

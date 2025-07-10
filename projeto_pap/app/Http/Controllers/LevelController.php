<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Level;
use App\Models\Template;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index(Game $game)
    {
        $levels = Level::where('game_id', $game->id)->get();

        return view('levels.index', compact('game', 'levels'));
    }

    public function show(Game $game, $id)
    {
        $level = Level::where('game_id', $game->id)->findOrFail($id);

        return view('levels.show', compact('game', 'level'));
    }

    public function create(Game $game)
    {
        $templates = Template::all();

        return view('levels.create', compact('game', 'templates'));
    }

    public function store(Request $request, Game $game)
    {
        $request->validate([
            'template_id' => 'required|exists:templates,id',
            'title' => 'required|string|max:255',
            'dialogues' => 'nullable|array',
            'dialogues.*.text' => 'required_with:dialogues|string',
            'dialogues.*.order_in_game' => 'nullable|integer',
        ]);

        $maxOrder = Level::where('game_id', $game->id)->max('order_in_game');

        $level = Level::create([
            'game_id' => $game->id,
            'template_id' => $request->template_id,
            'theme' => $request->title,
            'order_in_game' => $maxOrder ? $maxOrder + 1 : 1,
        ]);

        if ($request->has('dialogues')) {
            foreach ($request->dialogues as $dialogueData) {
                $level->dialogues()->create([
                    'speaker' => $dialogueData['speaker'] ?? 'guide',
                    'text' => $dialogueData['text'] ?? '',
                    'wait_for_input' => $dialogueData['wait_for_input'] ?? false,
                    'expected_input' => $dialogueData['expected_input'] ?? null,
                    'correct_response_text' => $dialogueData['correct_response_text'] ?? null,
                    'correct_response_speaker' => $dialogueData['correct_response_speaker'] ?? 'npc',
                    'wrong_response_text' => $dialogueData['wrong_response_text'] ?? null,
                    'wrong_response_speaker' => $dialogueData['wrong_response_speaker'] ?? 'npc',
                    'order_in_game' => $dialogueData['order_in_game'] ?? 0,
                ]);
            }
        }

        return redirect()->route('games.index', $game->id)
            ->with('success', 'Nível criado com sucesso!');
    }
}

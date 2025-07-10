<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            'description' => 'nullable|string',
            'status' => 'required|integer|in:0,1', // 👈 adicionar validação do status
        ]);

        try {
            Game::create([
                'title' => $request->title,
                'school' => $request->school,
                'code' => $request->code,
                'imagem' => $request->imagem,
                'description' => $request->description,
                'status' => $request->status, // 👈 guardar o status
                'created_by' => Auth::id(),
                'configuracao_json' => json_encode([
                    'title' => $request->title,
                ]),
            ]);
            return redirect()->back()->with('success', 'Jogo criado com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao criar o jogo: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro na criação. Tenta novamente.');
        }
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

    public function update(Request $request, Game $game)
    {
        // Validação
        $request->validate([
            'title' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'description' => 'nullable',
            'image_path' => 'nullable|image|max:2048',
            'status' => 'required|integer|in:0,1',  // valida o status
        ]);

        try {
            $game->title = $request->title;
            $game->school = $request->school;
            $game->description = $request->description;
            $game->status = $request->status;  // atualiza o status

            if ($request->hasFile('image_path')) {
                $path = $request->file('image_path')->store('games_images', 'public');
                $game->image_path = '/storage/' . $path;
            }

            $game->save();

            return redirect()->back()->with('success', 'Informações atualizadas com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar o jogo: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar. Tenta novamente.');
        }
    }

    public function destroy($id)
    {
        $game = Game::with('levels')->findOrFail($id);

        // Apagar todos os níveis associados primeiro
        foreach ($game->levels as $level) {
            $level->delete();
        }

        $game->delete();

        return redirect()->route('games.index')->with('success', 'Jogo e níveis associados eliminados com sucesso!');
    }

    public function play($id)
    {
        $userGame = Game::with(['levels.dialogues'])->findOrFail($id);

        $game = $userGame->toArray(); // <-- Tudo convertido automaticamente

        return view('play', compact('game'));
    }

    public function testeConfigJson($id)
    {
        $game = Game::findOrFail($id);
        return response()->json($game->configuracao_json);
    }

    public function community_index(Request $request)
    {
        $query = $request->input('q');

        // Consulta básica com filtro opcional
        $games = Game::when($query, function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('school', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        })
            ->where('status', true) // só jogos públicos
            ->orderBy('title')
            ->get();

        return view('community_games', ['games' => $games, 'searchQuery' => $query]);
    }

}

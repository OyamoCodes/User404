<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->search;

        // Base da query
        $query = Game::where('user_id', $user->id);

        // Se existir termo de pesquisa
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('school', 'like', '%' . $search . '%');
            });

            // Ordenar por maior correspondência (exato > parcial)
            $query->orderByRaw("
            CASE
                WHEN title LIKE ? THEN 1
                WHEN description LIKE ? THEN 2
                WHEN school LIKE ? THEN 3
                ELSE 4
            END
        ", ["%$search%", "%$search%", "%$search%"]);
        }

        // Paginação com 6 por página
        $games = $query->paginate(6)->withQueryString();

        return view('dashboard', compact('games'));
    }
}

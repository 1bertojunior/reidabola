<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Illuminate\Http\Request;

class ChampionshipController extends Controller
{
    protected $championship;

    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
    }

    public function index()
    {
        $championships = $this->championship->with('city')->get();
        return response()->json($championships);
    }

    public function show($id)
    {
        $championship = $this->championship->with('city')->find($id);

        if ($championship === null) {
            return response()->json(['error' => 'Campeonato não encontrado.'], 404);
        }

        return response()->json($championship);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->championship->rules(), $this->championship->feedback());

        $championship = $this->championship->create($request->all());

        return response()->json($championship, 201);
    }

    public function update(Request $request, $id)
    {
        $championship = $this->championship->find($id);

        if ($championship === null) {
            return response()->json(['error' => 'Campeonato não encontrado.'], 404);
        }

        $this->validate($request, $this->championship->rules(), $this->championship->feedback());

        $championship->update($request->all());

        return response()->json($championship);
    }

    public function destroy($id)
    {
        $championship = $this->championship->find($id);

        if ($championship === null) {
            return response()->json(['error' => 'Campeonato não encontrado.'], 404);
        }

        $championship->delete();

        return response()->json(['message' => 'Campeonato removido com sucesso.']);
    }
}

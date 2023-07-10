<?php

namespace App\Http\Controllers;

use App\Models\ChampionshipEdition;
use Illuminate\Http\Request;

class ChampionshipEditionController extends Controller
{
    protected $championshipEdition;

    public function __construct(ChampionshipEdition $championshipEdition)
    {
        $this->championshipEdition = $championshipEdition;
    }

    public function index()
    {
        $editions = $this->championshipEdition->with('championship')->get();
        return response()->json($editions);
    }

    public function show($id)
    {
        $edition = $this->championshipEdition->with('championship')->find($id);

        if ($edition === null) {
            return response()->json(['error' => 'Edição de campeonato não encontrada.'], 404);
        }

        return response()->json($edition);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->championshipEdition->rules(), $this->championshipEdition->feedback());

        $edition = $this->championshipEdition->create($request->all());

        return response()->json($edition, 201);
    }

    public function update(Request $request, $id)
    {
        $edition = $this->championshipEdition->find($id);

        if ($edition === null) {
            return response()->json(['error' => 'Edição de campeonato não encontrada.'], 404);
        }

        $this->validate($request, $this->championshipEdition->rules(), $this->championshipEdition->feedback());

        $edition->update($request->all());

        return response()->json($edition);
    }

    public function destroy($id)
    {
        $edition = $this->championshipEdition->find($id);

        if ($edition === null) {
            return response()->json(['error' => 'Edição de campeonato não encontrada.'], 404);
        }

        $edition->delete();

        return response()->json(['message' => 'Edição de campeonato removida com sucesso.']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\PlayerEdition;

class PlayerEditionController extends Controller
{
    protected $playerEdition;

    public function __construct(PlayerEdition $playerEdition)
    {
        $this->playerEdition = $playerEdition;
    }

    public function index()
    {
        try {
            $playerEditions = PlayerEdition::with('player.position', 'teamEdition.team')->get();

            return response()->json($playerEditions, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar as edições de jogador.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $playerEdition = PlayerEdition::with('player', 'teamEdition')->findOrFail($id);

            return response()->json($playerEdition, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Edição de jogador não encontrada.'], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->playerEdition->rules(), $this->playerEdition->feedback());

            $playerEdition = $this->playerEdition->create($request->all());

            return response()->json($playerEdition, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar edição de jogador.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $playerEdition = $this->playerEdition->findOrFail($id);

            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($this->playerEdition->rules() as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }

                $this->validate($request, $rules, $this->playerEdition->feedback());
            } else {
                $this->validate($request, $this->playerEdition->rules(), $this->playerEdition->feedback());
            }

            $playerEdition->update($request->all());

            return response()->json($playerEdition);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar edição de jogador.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $playerEdition = $this->playerEdition->findOrFail($id);

            $playerEdition->delete();

            return response()->json(['message' => 'Edição de jogador removida com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao remover edição de jogador.'], 500);
        }
    }
}

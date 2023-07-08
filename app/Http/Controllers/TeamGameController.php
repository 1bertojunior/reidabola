<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreTeamGameRequest;
// use App\Http\Requests\UpdateTeamGameRequest;

class TeamGameController extends Controller
{
    public $teamGame;

    public function __construct(TeamGame $teamGame){
        $this->teamGame = $teamGame;
    }

    public function index()
    {
        $teamGames = $this->teamGame->with('user')->get();
        return $teamGames;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate($this->teamGame->rules(), $this->teamGame->feedback());
        $teamGame = $this->teamGame->create($data);

        return $teamGame;
    }

    public function show($id)
    {
        $result = $this->teamGame->with('user')->find($id);
        if ($result === null) {
            $result = response()->json(['error' => "Nenhum dado encontrado."], 404);
        }
        return $result;
    }


    public function update(Request $request, $id)
    {
        $teamGame = $this->teamGame->find($id);

        if ($teamGame === null) {
            return response()->json(['error' => "Nenhum dado encontrado."], 404);
        } else {
            if ($request->method() === "PATCH") {
                $requestData = $request->all();

                $rules = array();
                foreach ($this->teamGame->rules($id) as $input => $rule) {
                    if (array_key_exists($input, $requestData)) {
                        $rules[$input] = $rule;
                    }
                }
                unset($rules['user_id']);
                $this->validate($request, $rules, $this->teamGame->feedback());
            } else {
                $rules = $this->teamGame->rules($id);
                unset($rules['user_id']);
                $this->validate($request, $rules, $this->teamGame->feedback());
            }

            $teamGame->update($request->except('user_id'));
        }

        return $teamGame;
    }


    public function destroy($id)
    {

        $result = $this->teamGame->find($id);

        $result = ($result === null) ? 0 : $result->delete();

        return $result ? ['msg' => "Removido com sucesso"] :  response()->json([ 'error' => "Nenhum dado encontrado"], 404); ;
    }
}

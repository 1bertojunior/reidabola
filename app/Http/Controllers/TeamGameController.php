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

    public function index(Request $request)
    {
        try {
            $data = array();

            if($request->has('att_user')){
                $att_user = $request->att_user;
                $data = $this->teamGame->with('user:id,' . $att_user);
            }else{
                $data = $this->teamGame->with('user');
            }

            $att = $request->att;
            if ($request->has('att')) {
                $data = $data->selectRaw($att)->get();
                // $data = $this->getDataWithByAttribute($this->teamGame, $att, 'user:id,' . $att_user);
            } else {
                $data = $data->teamGame->get();
                // $data = $this->getAllDataWith($this->teamGame, 'user');
            }

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
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
        $result = $this->teamGame->with('accessLevel')->find($id);
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

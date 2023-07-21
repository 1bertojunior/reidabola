<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Repositories\TeamGameRepository;
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
        $teamGameRepository = new TeamGameRepository($this->teamGame);
        $data = $this->teamGame;

        try{
            if ($request->has('att_user')) {
                $att_user = 'user:id,' .  $request->att_user;
                $teamGameRepository->selectAttributesRelated($att_user);
            } else {
                $teamGameRepository->selectAttributesRelated('user');
            }

            if ($request->has('filter')) {
                $teamGameRepository->filter($request->filter);                
            }

            if($request->has('att')){
                $teamGameRepository->selectAttributes($request->att);
                //     $att = $request->att;
        //     $data = $request->has('att') ? $data->selectRaw($att)->get() : $data->get();
            }

            $result  = $teamGameRepository->getResult();
            return response()->json( $result, 200 );
        }catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }

        // try {
        //     $data = $this->teamGame;
    
        //     if ($request->has('att_user')) {
        //         $att_user = $request->att_user;
        //         $data = $data->with('user:id,' . $att_user);
        //     } else {
        //         $data = $data->with('user');
        //     }
    
            // if ($request->has('filter')) {
            //     $filters = explode(';', $request->filter);
    
            //     foreach ($filters as $filter) {
            //         $f = explode(':', $filter);
    
            //         // Verificar se o filtro é em um atributo de relacionamento
            //         if (str_contains($f[0], '.')) {
            //             $relationFilter = explode('.', $f[0]);
            //             $data = $data->whereHas($relationFilter[0], function ($query) use ($relationFilter, $f) {
            //                 $query->where($relationFilter[1], $f[1], $f[2]);
            //             });
            //         } else {
            //             $data = $data->where($f[0], $f[1], $f[2]);
            //         }
            //     }
            // }
    
        //     $att = $request->att;
        //     $data = $request->has('att') ? $data->selectRaw($att)->get() : $data->get();
    
        //     return response()->json($data);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        // }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, $this->teamGame->rules(), $this->teamGame->feedback());

            $teamGame = $this->teamGame->create($request->all());

            return response()->json($teamGame, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating team edition.'], 500);
        }
    }

    public function show($id)
    {
        try {
            $teamGame = $this->teamGame->with('user')->findOrFail($id);
            return response()->json($teamGame, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Equipe não encontrada.'], 404);
        }
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

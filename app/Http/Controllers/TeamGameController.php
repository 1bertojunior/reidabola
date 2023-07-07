<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use App\Http\Requests\StoreTeamGameRequest;
use App\Http\Requests\UpdateTeamGameRequest;

class TeamGameController extends Controller
{
    public $teamGame;

    public function __construct(TeamGame $teamGame)
    {
        $this->teamGame = $teamGame;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamGames = $this->teamGame->all();
        return response()->json($teamGames, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeamGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamGameRequest $request)
    {
        // $request->validate( $this->teamGame->rules(), $this->teamGame->feedback() );
        
        // $teamGame = $this->teamGame->create([
        //     'name' => $request->name,
        //     'abb' => $request->abb,
        //     'user_id' => $request->user_id
        // ]);

        // return response()->json( $teamGame , 201);

        return "teste0";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->teamGame->find($id);
        if( $result === null) $result = response()->json([ 'error' => "Nenhum dado encontrado."], 404);
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamGame $teamGame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamGameRequest  $request
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamGameRequest $request, $id)
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

                $this->validate($request, $rules, $this->teamGame->feedback());
            } else {
                $this->validate($request, $this->teamGame->rules($id), $this->teamGame->feedback());
            }

            $teamGame->update($request->all());
        }

        return $teamGame;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->teamGame->find($id);

        $result = ($result === null) ? 0 : $result->delete();

        return $result ? ['msg' => "Removido com sucesso"] :  response()->json([ 'error' => "Nenhum dado encontrado"], 404); ;
    }
}

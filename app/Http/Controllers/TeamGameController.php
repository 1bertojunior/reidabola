<?php

namespace App\Http\Controllers;

use App\Models\TeamGame;
use App\Http\Requests\StoreTeamGameRequest;
use App\Http\Requests\UpdateTeamGameRequest;

class TeamGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function show(TeamGame $teamGame)
    {
        //
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
    public function update(UpdateTeamGameRequest $request, TeamGame $teamGame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamGame  $teamGame
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamGame $teamGame)
    {
        //
    }
}

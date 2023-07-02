<?php

namespace App\Http\Controllers;

use App\Models\TeamEdition;
use App\Http\Requests\StoreTeamEditionRequest;
use App\Http\Requests\UpdateTeamEditionRequest;

class TeamEditionController extends Controller
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
     * @param  \App\Http\Requests\StoreTeamEditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamEditionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamEdition  $teamEdition
     * @return \Illuminate\Http\Response
     */
    public function show(TeamEdition $teamEdition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamEdition  $teamEdition
     * @return \Illuminate\Http\Response
     */
    public function edit(TeamEdition $teamEdition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeamEditionRequest  $request
     * @param  \App\Models\TeamEdition  $teamEdition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamEditionRequest $request, TeamEdition $teamEdition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamEdition  $teamEdition
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamEdition $teamEdition)
    {
        //
    }
}

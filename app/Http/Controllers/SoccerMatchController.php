<?php

namespace App\Http\Controllers;

use App\Models\SoccerMatch;
use App\Http\Requests\StoreSoccerMatchRequest;
use App\Http\Requests\UpdateSoccerMatchRequest;

class SoccerMatchController extends Controller
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
     * @param  \App\Http\Requests\StoreSoccerMatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoccerMatchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SoccerMatch  $soccerMatch
     * @return \Illuminate\Http\Response
     */
    public function show(SoccerMatch $soccerMatch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SoccerMatch  $soccerMatch
     * @return \Illuminate\Http\Response
     */
    public function edit(SoccerMatch $soccerMatch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSoccerMatchRequest  $request
     * @param  \App\Models\SoccerMatch  $soccerMatch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoccerMatchRequest $request, SoccerMatch $soccerMatch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SoccerMatch  $soccerMatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(SoccerMatch $soccerMatch)
    {
        //
    }
}

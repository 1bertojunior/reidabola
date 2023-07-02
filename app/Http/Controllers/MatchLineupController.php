<?php

namespace App\Http\Controllers;

use App\Models\MatchLineup;
use App\Http\Requests\StoreMatchLineupRequest;
use App\Http\Requests\UpdateMatchLineupRequest;

class MatchLineupController extends Controller
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
     * @param  \App\Http\Requests\StoreMatchLineupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchLineupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchLineup  $matchLineup
     * @return \Illuminate\Http\Response
     */
    public function show(MatchLineup $matchLineup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchLineup  $matchLineup
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchLineup $matchLineup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchLineupRequest  $request
     * @param  \App\Models\MatchLineup  $matchLineup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchLineupRequest $request, MatchLineup $matchLineup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchLineup  $matchLineup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchLineup $matchLineup)
    {
        //
    }
}

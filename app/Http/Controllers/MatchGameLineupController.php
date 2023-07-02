<?php

namespace App\Http\Controllers;

use App\Models\MatchGameLineup;
use App\Http\Requests\StoreMatchGameLineupRequest;
use App\Http\Requests\UpdateMatchGameLineupRequest;

class MatchGameLineupController extends Controller
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
     * @param  \App\Http\Requests\StoreMatchGameLineupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchGameLineupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchGameLineup  $matchGameLineup
     * @return \Illuminate\Http\Response
     */
    public function show(MatchGameLineup $matchGameLineup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchGameLineup  $matchGameLineup
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchGameLineup $matchGameLineup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchGameLineupRequest  $request
     * @param  \App\Models\MatchGameLineup  $matchGameLineup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchGameLineupRequest $request, MatchGameLineup $matchGameLineup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchGameLineup  $matchGameLineup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchGameLineup $matchGameLineup)
    {
        //
    }
}

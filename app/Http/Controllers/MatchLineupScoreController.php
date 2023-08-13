<?php

namespace App\Http\Controllers;

use App\Models\MatchLineupScore;
use App\Http\Requests\StoreMatchLineupScoreRequest;
use App\Http\Requests\UpdateMatchLineupScoreRequest;

class MatchLineupScoreController extends Controller
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
     * @param  \App\Http\Requests\StoreMatchLineupScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchLineupScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchLineupScore  $matchLineupScore
     * @return \Illuminate\Http\Response
     */
    public function show(MatchLineupScore $matchLineupScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchLineupScore  $matchLineupScore
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchLineupScore $matchLineupScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchLineupScoreRequest  $request
     * @param  \App\Models\MatchLineupScore  $matchLineupScore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchLineupScoreRequest $request, MatchLineupScore $matchLineupScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchLineupScore  $matchLineupScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchLineupScore $matchLineupScore)
    {
        //
    }
}

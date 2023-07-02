<?php

namespace App\Http\Controllers;

use App\Models\MatchGoalStats;
use App\Http\Requests\StoreMatchGoalStatsRequest;
use App\Http\Requests\UpdateMatchGoalStatsRequest;

class MatchGoalStatsController extends Controller
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
     * @param  \App\Http\Requests\StoreMatchGoalStatsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMatchGoalStatsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchGoalStats  $matchGoalStats
     * @return \Illuminate\Http\Response
     */
    public function show(MatchGoalStats $matchGoalStats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchGoalStats  $matchGoalStats
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchGoalStats $matchGoalStats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMatchGoalStatsRequest  $request
     * @param  \App\Models\MatchGoalStats  $matchGoalStats
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMatchGoalStatsRequest $request, MatchGoalStats $matchGoalStats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchGoalStats  $matchGoalStats
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchGoalStats $matchGoalStats)
    {
        //
    }
}

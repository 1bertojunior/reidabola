<?php

namespace App\Http\Controllers;

use App\Models\PlayerGameScore;
use App\Http\Requests\StorePlayerGameScoreRequest;
use App\Http\Requests\UpdatePlayerGameScoreRequest;

class PlayerGameScoreController extends Controller
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
     * @param  \App\Http\Requests\StorePlayerGameScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerGameScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayerGameScore  $playerGameScore
     * @return \Illuminate\Http\Response
     */
    public function show(PlayerGameScore $playerGameScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerGameScore  $playerGameScore
     * @return \Illuminate\Http\Response
     */
    public function edit(PlayerGameScore $playerGameScore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayerGameScoreRequest  $request
     * @param  \App\Models\PlayerGameScore  $playerGameScore
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayerGameScoreRequest $request, PlayerGameScore $playerGameScore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayerGameScore  $playerGameScore
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayerGameScore $playerGameScore)
    {
        //
    }
}

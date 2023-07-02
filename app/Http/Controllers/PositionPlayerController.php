<?php

namespace App\Http\Controllers;

use App\Models\PositionPlayer;
use App\Http\Requests\StorePositionPlayerRequest;
use App\Http\Requests\UpdatePositionPlayerRequest;

class PositionPlayerController extends Controller
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
     * @param  \App\Http\Requests\StorePositionPlayerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionPlayerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PositionPlayer  $positionPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(PositionPlayer $positionPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PositionPlayer  $positionPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionPlayer $positionPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePositionPlayerRequest  $request
     * @param  \App\Models\PositionPlayer  $positionPlayer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionPlayerRequest $request, PositionPlayer $positionPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PositionPlayer  $positionPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionPlayer $positionPlayer)
    {
        //
    }
}

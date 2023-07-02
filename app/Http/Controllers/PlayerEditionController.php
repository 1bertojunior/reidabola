<?php

namespace App\Http\Controllers;

use App\Models\PlayerEdition;
use App\Http\Requests\StorePlayerEditionRequest;
use App\Http\Requests\UpdatePlayerEditionRequest;

class PlayerEditionController extends Controller
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
     * @param  \App\Http\Requests\StorePlayerEditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerEditionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlayerEdition  $playerEdition
     * @return \Illuminate\Http\Response
     */
    public function show(PlayerEdition $playerEdition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlayerEdition  $playerEdition
     * @return \Illuminate\Http\Response
     */
    public function edit(PlayerEdition $playerEdition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayerEditionRequest  $request
     * @param  \App\Models\PlayerEdition  $playerEdition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayerEditionRequest $request, PlayerEdition $playerEdition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlayerEdition  $playerEdition
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlayerEdition $playerEdition)
    {
        //
    }
}

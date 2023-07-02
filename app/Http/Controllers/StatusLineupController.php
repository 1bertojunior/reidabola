<?php

namespace App\Http\Controllers;

use App\Models\StatusLineup;
use App\Http\Requests\StoreStatusLineupRequest;
use App\Http\Requests\UpdateStatusLineupRequest;

class StatusLineupController extends Controller
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
     * @param  \App\Http\Requests\StoreStatusLineupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusLineupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusLineup  $statusLineup
     * @return \Illuminate\Http\Response
     */
    public function show(StatusLineup $statusLineup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusLineup  $statusLineup
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusLineup $statusLineup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusLineupRequest  $request
     * @param  \App\Models\StatusLineup  $statusLineup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusLineupRequest $request, StatusLineup $statusLineup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusLineup  $statusLineup
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusLineup $statusLineup)
    {
        //
    }
}

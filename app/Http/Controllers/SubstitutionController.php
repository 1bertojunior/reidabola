<?php

namespace App\Http\Controllers;

use App\Models\Substitution;
use App\Http\Requests\StoreSubstitutionRequest;
use App\Http\Requests\UpdateSubstitutionRequest;

class SubstitutionController extends Controller
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
     * @param  \App\Http\Requests\StoreSubstitutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubstitutionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Substitution  $substitution
     * @return \Illuminate\Http\Response
     */
    public function show(Substitution $substitution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Substitution  $substitution
     * @return \Illuminate\Http\Response
     */
    public function edit(Substitution $substitution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubstitutionRequest  $request
     * @param  \App\Models\Substitution  $substitution
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubstitutionRequest $request, Substitution $substitution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Substitution  $substitution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Substitution $substitution)
    {
        //
    }
}

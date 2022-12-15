<?php

namespace App\Http\Controllers;

use App\Models\sessions;
use App\Http\Requests\StoresessionsRequest;
use App\Http\Requests\UpdatesessionsRequest;

class SessionsController extends Controller
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
     * @param  \App\Http\Requests\StoresessionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresessionsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sessions  $sessions
     * @return \Illuminate\Http\Response
     */
    public function show(sessions $sessions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sessions  $sessions
     * @return \Illuminate\Http\Response
     */
    public function edit(sessions $sessions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesessionsRequest  $request
     * @param  \App\Models\sessions  $sessions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesessionsRequest $request, sessions $sessions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sessions  $sessions
     * @return \Illuminate\Http\Response
     */
    public function destroy(sessions $sessions)
    {
        //
    }
}

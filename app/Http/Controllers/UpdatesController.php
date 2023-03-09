<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatesRequest;
use App\Http\Requests\UpdateUpdatesRequest;
use App\Models\Updates;

class UpdatesController extends Controller
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
     * @param  \App\Http\Requests\StoreUpdatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatesRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'update' => 'required',
            'task_id' => 'required'
        ]);
       // dd($request);

        Updates::create($request->all());

        return redirect()->back()->with('success', 'Update created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Updates  $updates
     * @return \Illuminate\Http\Response
     */
    public function show(Updates $updates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Updates  $updates
     * @return \Illuminate\Http\Response
     */
    public function edit(Updates $updates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUpdatesRequest  $request
     * @param  \App\Models\Updates  $updates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUpdatesRequest $request, Updates $updates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Updates  $updates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Updates $updates)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiskRequest;
use App\Http\Requests\UpdateRiskRequest;
use App\Models\Risk;

class RiskController extends Controller
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
     * @param  \App\Http\Requests\StoreRiskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRiskRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'task_id' => 'required'
        ]);
       // dd($request);

        Risk::create($request->all());

        return redirect()->back()->with('success', 'Risk created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function show(Risk $risk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function edit(Risk $risk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRiskRequest  $request
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiskRequest $request, Risk $risk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Risk  $risk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Risk $risk)
    {
        //
    }

    public function complete(Risk $risk){
        $new_risk = Risk::find($risk->id);
        $new_risk->completed =1 ;
        $new_risk->save();
        return redirect()->back()->with('success', 'Risk completed successfully!');
    }
}

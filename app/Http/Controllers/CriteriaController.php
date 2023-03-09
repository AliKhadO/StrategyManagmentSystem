<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Models\Criteria;
use App\Models\Task;
use Illuminate\Http\Request;

class CriteriaController extends Controller
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
     * @param  \App\Http\Requests\StoreCriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCriteriaRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'task_id' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);
        // dd($request);

        Criteria::create($request->all());

        return redirect()->back()->with('success', 'Criteria created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCriteriaRequest  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCriteriaRequest $request, Criteria $criteria)
    {
        dd($request);
    }


    public function complete(Request $request)
    {

        $id = $request->id;
        $val = $request->value;
        $criteria = Criteria::find($id);
        $criteria->complete_percent = $val;
        if ($val = 100) {
            $criteria->completed = 1;
        }
        $criteria->save();

        $task = Task::find($criteria->task_id);
        $task_completed = $task->criterias()->count() == $task->criterias()->get()->where('completed', 1)->count();
        $task->status = 1;
        $task->save();


        return response()->json(['code' => 0, 'message' => 'Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}

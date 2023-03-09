<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Models\Department;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GoalController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Goal::class, 'goal');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Goal::all();
        return view('goal.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $departments = Department::all(['name', 'id']);
        $plans = Plan::all();
        return view('goal.create', compact('team_leaders', 'plans', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGoalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoalRequest $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'timeframe_start_date' => 'required',
                'timeframe_end_date' => 'required',
                'department_id' => 'required'
            ],
            [
                'department_id.required' => 'Please Assign to Department'
            ]
        );
        $goal = new Goal();
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->timeframe_start_date = $request->timeframe_start_date;
        $goal->timeframe_end_date = $request->timeframe_end_date;
        if($request->timeframe_end_date < now()){
            $goal->actual_end_date = now();
            $goal->status = 2 ;
        }
        $goal->department_id = $request->department_id;
        $goal->type = $request->type ?? 0;
        $goal->created_by_id = Auth::user()->id;
        $goal->save();
        return redirect('/goals')->with('success', 'Goal created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        $goal = Goal::find($goal->id);
        $departments = Department::all(['name', 'id']);
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $plans = Plan::all();
        return view('goal.show', compact('goal', 'team_leaders', 'plans', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        $goal = Goal::find($goal->id);
        $departments = Department::all(['name', 'id']);
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $plans = Plan::all();
        return view('goal.edit', compact('goal', 'team_leaders', 'plans', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoalRequest  $request
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'timeframe_start_date' => 'required',
                'timeframe_end_date' => 'required',
                'department_id' => 'required'
            ],
            [
                'department_id.required' => 'Please Assign to Department'
            ]
        );
        $goal = Goal::find($goal->id);
        $goal->name = $request->name;
        $goal->description = $request->description;
        $goal->timeframe_start_date = $request->timeframe_start_date;
        $goal->timeframe_end_date = $request->timeframe_end_date;
        $goal->department_id = $request->department_id;
        $goal->created_by_id = Auth::user()->id;
        // dd($request);
        if ($request->complete) {
            $goal->actual_end_date = now();
            $goal->status = 1;
        } else {
            if ($request->timeframe_end_date < now()) {
                $goal->actual_end_date = now();
                $goal->status = 2;
            } else {
                $goal->actual_end_date = null;
                $goal->status = 0;
            }
        }
        $goal->type = $request->type ?? 0;
        $goal->save();
        return redirect('/goals')->with('success', 'Goal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->back()->with('success', 'Goal deleted successfully!');
    }
}

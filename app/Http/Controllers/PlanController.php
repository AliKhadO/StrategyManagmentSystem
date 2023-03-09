<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Department;
use App\Models\Goal;
use App\Models\Plan;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Plan::class, 'plan');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $plans = Plan::all();
        return view('plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all(['name', 'id']);
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $goals = Goal::all();
        return view('plan.create', compact('departments', 'team_leaders', 'goals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlanRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'timeframe_start_date' => 'required',
            'timeframe_end_date' => 'required'
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->timeframe_start_date = $request->timeframe_start_date;
        $plan->timeframe_end_date = $request->timeframe_end_date;
        if ($request->timeframe_end_date < now()) {
            $plan->actual_end_date = now();
            $plan->status = 2;
        }
        $plan->created_by_id = Auth::user()->id;
        $plan->assigned_to_id = $request->assigned_to_id;
        $plan->goal_id = $request->goal_id;
        $plan->save();
        return redirect('/plans')->with('success', 'Plan created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        $departments = Department::all(['name', 'id']);
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $goals = Goal::all();

        $plan = Plan::find($plan->id);
        return view('plan.show', compact('plan', 'departments', 'team_leaders', 'goals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        $departments = Department::all(['name', 'id']);
        $team_leaders = User::role('team_leader')->get(); // Returns only users with the role 'writer'\
        $plan = Plan::find($plan->id);
        $goals = Goal::all();

        return view('plan.edit', compact('plan', 'departments', 'team_leaders', 'goals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlanRequest  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {

        $plan = Plan::find($request->id);
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'timeframe_start_date' => 'required',
            'timeframe_end_date' => 'required'
        ]);

        $plan->name = $request->name;
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->timeframe_start_date = $request->timeframe_start_date;
        $plan->timeframe_end_date = $request->timeframe_end_date;
        $plan->created_by_id = Auth::user()->id;
        $plan->goal_id = $request->goal_id;
        $plan->assigned_to_id = $request->assigned_to_id;
        // dd($request);
        if ($request->complete) {
            $plan->actual_end_date = now();
            $plan->status = 1;
        } else {
            if ($request->timeframe_end_date < now()) {
                $plan->actual_end_date = now();
                $plan->status = 2;
            } else {
                $plan->actual_end_date = null;
                $plan->status = 0;
            }
        }
        $plan->save();
        return redirect('/plans')->with('success', 'Plan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect('/plans')->with('success', 'Plan deleted successfully!');
    }

    public function favorite(Plan $plan)
    {
        $plan->type = !$plan->type;
        $plan->save();
        return redirect('/plans')->with('success', 'Plan updated successfully!');
    }

    public function read(Plan $plan)
    {
        $plan->notification_status = 2; // mark as read
        $plan->save();
        return redirect('/plans')->with('success', 'Plan updated successfully!');
    }
}

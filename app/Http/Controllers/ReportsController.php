<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use Illuminate\Http\Request;

class ReportsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function plans()
    {
        $completed =  Plan::where('status', 0)->get()->count();
        $exceded =  Plan::where('status', 2)->get()->count();
        $all =  Plan::all()->count();
        $pending =  Plan::where('status', 1)->get()->count();
        return json_encode(['Completed' => $completed, 'Pending' => $pending, 'Total' => $all, 'Exceded' => $exceded]);
    }


    public function tasks()
    {
        $completed =  Task::where('status', 0)->get()->count();
        $exceded =  Task::where('status', 2)->get()->count();
        $all =  Task::all()->count();
        $pending =  Task::where('status', 1)->get()->count();
        return json_encode(['Completed' => $completed, 'Pending' => $pending, 'Total' => $all, 'Exceded' => $exceded]);
    }


    public function goals()
    {
        $completed =  Goal::where('status', 0)->get()->count();
        $exceded =  Goal::where('status', 2)->get()->count();
        $all =  Goal::all()->count();
        $pending =  Goal::where('status', 1)->get()->count();
        return json_encode(['Completed' => $completed, 'Pending' => $pending, 'Total' => $all, 'Exceded' => $exceded]);
    }

    public function slaks()
    {
        $plan_slakers =  Plan::with(['created_by'])->where('status', 2)->get(); //status exceeded
        $goal_slakers =  Goal::with(['created_by'])->where('status', 2)->get(); //status exceeded
        $task_slakers =  Task::with(['created_by'])->where('status', 2)->get(); //status exceeded
        return json_encode(['plans' => $plan_slakers, 'goals' => $goal_slakers, 'tasks' => $task_slakers]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $users = User::all();
        $plans = Plan::all();
        return view('task.index', compact('tasks', 'users','plans'));
    }


    public function mytasks()
    {
        $tasks = Task::where('assigned_to_id', Auth::user()->id)->get();
        $users = User::all();
        $plans = Plan::all();
        return view('task.index', compact('tasks', 'users','plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'assigned_to_id' => 'required'
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->plan_id = $request->plan_id;
        $task->created_by_id = Auth::user()->id;
        $task->save();
        return redirect()->back()->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {

        $task = Task::find($task->id);
        return view('task.show', compact('task', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {

        $task = Task::find($task->id);
        //dd($task->risks()->get());
        $users = User::all();
        return view('task.edit', compact('task', 'users'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {

        $task = Task::find($request->id);
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required'

        ]);
        $task->name = $request->name;
        $task->description = $request->description;
        // dd($request);
        if ($request->complete) {
            $task->actual_end_date = now();
        }
        $task->save();
        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks')->with('success', 'Task deleted successfully!');
    }

    public function favorite(Task $task)
    {
        $task->type = !$task->type;
        $task->save();
        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    public function read(Task $task)
    {
        $task->notification_status = 2; // mark as read
        $task->save();
        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }


    public function complete(Task $task)
    {
        $complete = Task::find($task->id)->criterias()->get()->avg('complete_percent');
        return response()->json(['code' => 0, 'message' => 'Success', 'data' => $complete]);
    }
}

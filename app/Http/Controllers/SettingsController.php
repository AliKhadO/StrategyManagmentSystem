<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        $users = User::all();
        return view('settings.index', compact('departments', 'users'));
    }

    public function change_dept(Request $request)
    {
        //dd($request);
        $user = User::find($request->user_id);
        $user->department_id = $request->new_dept_id;
        $user->save();
        return response()->json(['code' => 0, 'message' => 'Success']);
    }

    public function store_department(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required'
        ]);

        $dept = new Department();
        $dept->name = $request->name;
        $dept->description = $request->description;
        $dept->location = $request->location;
        $dept->save();
        return redirect()->back()->with('success', 'Department created successfully!');
    }
}

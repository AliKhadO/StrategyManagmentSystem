<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $users = User::all();
        return view('departments.index', compact('departments', 'users'));
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



    public function change_dept(Request $request)
    {
        //dd($request);
        $user = User::find($request->user_id);
        $user->department_id = $request->new_dept_id;
        $user->save();
        return response()->json(['code' => 0, 'message' => 'Success']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $department = Department::find($department->id);
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $request->validate(
            [
                'name' => 'required',
                'location' => 'required'
            ]
        );
        $department = Department::find($department->id);
        $department->name = $request->name;
        $department->location = $request->location;
        $department->save();
        return redirect()->back()->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully!');
    }
}

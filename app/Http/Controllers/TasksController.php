<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
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
    public function create(Request $request)
    {
        $task = Tasks::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'created_by' => Auth::user()->id
        ]);

        $task_assigned = TaskAssignment::create([
            'assigned_to' => $request->assignedTo,
            'assigned_by' => Auth::user()->id,
            'task_id' => $task->id
        ]);

        return Tasks::getTasks();
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        return Tasks::getTasks();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        Tasks::where('id',$request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);

        TaskAssignment::where('id',$request->id)->update([
            'assigned_to' => $request->assignedTo
        ]);

        return Tasks::getTasks();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        if($request->id) Tasks::where('id',$request->id)->delete();
        
        return Tasks::getTasks();
    }
}

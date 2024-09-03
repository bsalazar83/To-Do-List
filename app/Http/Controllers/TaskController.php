<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Tasks.index');
    }

    public function all()
    {
        $tasks = Task::with('user')->orderBy('id','asc')->get();
        return response()->json($tasks);
    }

    public function complete($id)
    {
        $task = Task::find($id);

        if ($task) {
            $task->status = 'completed';
            $task->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
        ]);
        // $request->user()->tasks()->create($validated);
        $task = $request->user()->tasks()->create($validated);
        $user = $request->user();

        return response()->json([
            'id' => $task->id,
            'task' => $task->task,
            'deadline' => $task->deadline,
            'status' => $task->status,
            'user_id' => $user->id,
            'user_name' => $user->name
        ]);

        // return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
       
    }
}

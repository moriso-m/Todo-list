<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class TaskController extends Controller
{
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
        // check if user is authenticated
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $tasks = $user->tasks;

            return view('home', ['tasks' => $tasks]);
        }
        else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tasks = Task::where('user_id',Auth::user()->id);

        return view('create-task',['tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required | string',
            'description' =>'required|string',
            'date' => 'required',
        ]);
        // dd($request->all());
        Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date_due' => $validatedData['date'],
            'time_due' => $request->input('time'),
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/tasks')->with('success','You have successfully added a task to the to do list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
        return view('edit-tasks',['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $validated = $request->validate([
            'title' => 'required | string',
            'description' =>'required|string',
            'date' => 'required',
            'time' => 'required',
        ]);
        if ($request->input('completed')) {
            $completed =true;
        }
        else{
            $completed = 0;
        }
        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'completed' => $completed,
        ]);

        return redirect('/tasks')->with('success','You have successfully updated a task on the todo list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();

        return redirect('/tasks')->with('success','You have successfully deleted a task on the todo list');
    }
}

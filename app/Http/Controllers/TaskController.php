<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\PushToTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        //$tasks = Task::where('user_id',Auth::id())->orderBy('due_date')->paginate(10); 
        if(request()->has('suche'))
        {
            $suche = request()->suche;
            $tasks = Task::where('title','LIKE',"%$suche%")->paginate(10);
        }
        else
        {
            // $tasks = Auth::user()->tasks()->paginate(10);
            $tasks = Task::paginate(10);
        }
        // $tasks = Task::paginate(10);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('tasks.create',[
            'task'=>new Task,
            'users'=>User::get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        
        $task = new Task();
        $task->title    = $request->input('title'); 
        $task->status   = $request->input('status');
        $task->due_date = $request->input('due_date');
        $task->notes    = $request->input('notes'); 
        $task->save(); // Auth::user()->tasks()->create(['title' => $request('title'), ...]);

        // In Zwischentabelle schreiben
        $task->users()->attach($request->input('users'));

        foreach($request->input('users') as $userId)
            {
                $user = User::find($userId);//where('id',$userId)->get();
                $user->notify(new PushToTask($task));
                // $userId->notify();
            }

        return redirect('/tasks')->with('success', 'Task wurde erstellt.');
    }

    public function show(Task $task) // //model binding
    {        
                
                // if($task->user_id != Auth::user()->id)
                // {
                //    abort(404);
                // }   
                Gate::authorize('task-entry',$task);
                return view('tasks.show', ['task'=>$task]);
       
    }

    public function edit(Task $task)
    {
        Gate::authorize('task-entry',$task);
        $users = User::get();
        return view('tasks.edit', compact('task','users'));
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('task-entry',$task);
        
        $this->validation($request);

        $task->title    = $request->input('title'); 
        $task->status   = $request->input('status');
        $task->due_date = $request->input('due_date');
        $task->notes    = $request->input('notes'); 
        $task->save();
        // Zwischentabelle aktualisieren
        $task->users()->sync($request->input('users'));

        return redirect("/tasks/$task->id")->with('success', 'Task wurde aktualisiert.');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('task-entry',$task);
        $task->delete();
        return redirect('/tasks')->with('success', 'Task wurde gelöscht.');
    }

    private function validation(Request $request)
    {
        $request->validate([
            'title'    => ['required', 'string', 'min:3', 'max:120'],
            'status'   => ['required', 'in:open,done'],
            'users'    => ['required','array'],
            'due_date' => ['nullable', 'date'],
            'notes'    => ['nullable', 'string', 'max:1000'],
        ]);
    }

}

<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DBTestController extends Controller
{
    public function test()
    {
        //$ds = Task::all();  // Alle Datensätze
        //$ds = Task::get();  // Alle Datensätze
        //$ds = Task::where('id',5)->get();  // Nur Datensatz mit id 5
        //$ds = Task::where('id','!=',5)->get();  // Alles außer id 5
        //$ds = Task::find(5); // Mit id 5
        //$ds = Task::get(['title','status']); // Alles aber nur title und status
        //$task = new Task; $ds = $task->find(2000); // Über Model-Instanz
        //$task = new Task; $ds = $task->findOrFail(2000); // 404 Seite Über Model-Instanz
        //$ds = Task::findOrFail(100);
        //$ds = Task::paginate(2); // Mehr Daten als erwartet
        //$ds = DB::select('SELECT * FROM tasks'); // Über Facade
        //$ds = DB::select('SELECT * FROM tasks WHERE id = 5');
        //$ds = DB::select('SELECT * FROM tasks WHERE id = ?',[2]);
        //$ds = DB::select('SELECT * FROM tasks WHERE id = ?',[request('id')]);// ?id=5 in der URL
        //$ds = DB::table('tasks')->get();
        //$ds = Task::count(); // Zählt Datensätze
        //$ds = Task::latest()->get(); 
        //$ds = Task::orderBy('title')->get();
        //$ds = User::all();
        //$ds = Auth::user()->tasks;
        $ds = User::find(1)->tasks;
        
        return $ds;
    }
}

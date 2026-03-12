<?php

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Test\DBTestController;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::view('/', 'welcome');

// Route::resource('tasks', TaskController::class);             // Alternative zu den 7 Einzelroutes

Route::middleware('auth')->group(function(){
    // Resource tasks
    Route::get('/tasks',[TaskController::class,'index']);//->middleware('auth');    //->name('task.index');
    Route::get('/tasks/create',[TaskController::class,'create']);   //->name('task.create');
    Route::post('/tasks',[TaskController::class,'store']);          //->name('task.store');
    Route::get('/tasks/{task}',[TaskController::class,'show']);
    Route::get('/tasks/{task}/edit',[TaskController::class,'edit']);
    Route::put('/tasks/{task}',[TaskController::class,'update']);
    Route::delete('/tasks/{task}',[TaskController::class,'destroy']);
    // Logout
    Route::get('/logout',[SessionController::class,'destroy']);
});

Route::middleware('guest')->group(function(){
    // Auth
    Route::get("/register",[RegistrationController::class,'create']);
    Route::post("/register",[RegistrationController::class,'store']);
    // Login
    Route::get('/login',[SessionController::class,'create'])->name('login');
    Route::post('/login',[SessionController::class,'store']); 
});

// Zu Testzwecken
Route::get("/dbtest",[DBTestController::class,'test']);



Route::get('notifications/mark-as-read', function() {
    $user = Auth::user();
    $user->unreadNotifications->markAsRead();
    return back();
});

<?php

namespace App\Providers;

use Illuminate\Auth\Access\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // NEU
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive(); // NEU

        Gate::define('task-entry',function($user,$task){
            // return (Auth::user()->id  == $task->user_id) ? Response::allow() : Response::denyAsNotFound();
            return true;
        });
    }
}

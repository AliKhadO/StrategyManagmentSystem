<?php

namespace App\Providers;

use App\Models\Goal;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $plan_slakers =  Plan::with(['created_by'])->where([['status', 2], ['notification_status', 1]])->get(); //status exceeded
            $goal_slakers =  Goal::with(['created_by'])->where([['status', 2], ['notification_status', 1]])->get(); //status exceeded
            $task_slakers =  Task::with(['created_by'])->where([['status', 2], ['notification_status', 1]])->get(); //status exceeded
            $slakers = ['plans' => $plan_slakers, 'goals' => $goal_slakers, 'tasks' => $task_slakers];
            $roles = null ; 
            if (!Auth::guest()) {
                $id = Auth::user()->id;
                $user = User::find($id);
                $roles = $user->getAllPermissions()->map(function ($x) {
                    return $x->name;
                });
            }
            $view->with(['slakers' => $slakers, 'roles' => $roles]);
        });
    }
}

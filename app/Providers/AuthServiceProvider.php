<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Plan;
use App\Policies\GoalPolicy;
use App\Policies\PlanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //  'App\Models\Model' => 'App\Policies\ModelPolicy',
         Plan::class => PlanPolicy::class,
         Goal::class => GoalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
<?php

namespace App\Policies;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('show plans')) {
            return true;
        }
        return true;
    }


    public function index(User $user)
    {
        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('show plans')) {
            return true;
        }
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Plan $plan)
    {

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('show plans')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('add plans')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Plan $plan)
    {
        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('edit plans')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Plan $plan)
    {
        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }
        // admin overrides published status
        if ($user->can('delete plans')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Plan $plan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Plan $plan)
    {
        //
    }
}

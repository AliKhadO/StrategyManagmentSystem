<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Plan extends Model
{
    use HasFactory;

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id', 'id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function complete_tasks()
    {
        return $this->hasMany(Task::class)->where("status", 1)->get(); //complete
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }



    public function complete_tasks_percent()
    {
        $percent =  $this->tasks()->count() > 0 ?  $this->hasMany(Task::class)->where("status", 1)->get()->count() / $this->tasks()->count()
            : 0;
        return $percent * 100; //complete
    }

   
}

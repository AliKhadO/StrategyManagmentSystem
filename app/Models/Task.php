<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;



    public function parent_plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }

    public function risks()
    {
        return $this->hasMany(Risk::class , 'task_id' , 'id');
    }


    public function updates()
    {
        return $this->hasMany(Updates::class , 'task_id' , 'id');
    }


    public function criterias()
    {
        return $this->hasMany(Criteria::class , 'task_id' , 'id');
    }



    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id', 'id');
    }
}

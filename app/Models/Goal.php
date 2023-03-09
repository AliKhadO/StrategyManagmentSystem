<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id', 'id');
    }



    public function plans()
    {
        return $this->hasMany(Plan::class);
    }


    public function complete_plans()
    {
        return $this->hasMany(Plan::class)->where("status", 1)->get(); //complete
    }

    public function department()
    {
        return $this->belongsTo(Department::class , 'department_id');
    }


    public function complete_plans_percent()
    {
        $percent =  $this->plans()->count() > 0 ?  $this->hasMany(Plan::class)->where("status", 1)->get()->count() / $this->plans()->count()
            : 0;
        return $percent * 100; //complete
    }
}

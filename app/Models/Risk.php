<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'task_id' , 'type' , 'completed'];

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_id');
    }

}

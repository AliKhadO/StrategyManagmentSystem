<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'from' , 'to' , 'complete_percent' , 'completed' , 'task_id'];

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_id');
    }
}

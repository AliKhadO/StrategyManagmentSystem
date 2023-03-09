<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Updates extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'update', 'task_id'];

    public function task()
    {
        return $this->belongsToMany(Task::class, 'task_id');
    }
}

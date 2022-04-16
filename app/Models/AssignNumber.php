<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignNumber extends Model
{
    use HasFactory;

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}

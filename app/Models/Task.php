<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->with('admissions');
    }

//    public function number()
//    {
//        return $this->hasOne(AssignNumber::class, 'task_id', 'id');
//    }

    public function interestes(){
        return $this->hasOne(Intereste::class);
    }
}

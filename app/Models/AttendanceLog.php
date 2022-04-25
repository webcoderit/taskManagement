<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['in_time', 'out_time', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
}

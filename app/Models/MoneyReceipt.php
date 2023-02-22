<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class MoneyReceipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'admission_id';
    protected $guarded = [];

//    protected $dates = ['admission_date'];

    public function getAdmissionDateAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function admissionForm()
    {
        return $this->belongsTo(AdmissionForm::class, 'admission_id', 'id')->with('user', 'admin');
    }

    public function dueCollect()
    {
        return $this->hasMany(DueCollect::class, 'due_id', 'id');
    }
}

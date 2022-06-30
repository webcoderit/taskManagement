<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MoneyReceipt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getAdmissionDateAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function admissionForm()
    {
        return $this->belongsTo(AdmissionForm::class, 'admission_id', 'id')->with('user', 'admin');
    }
}

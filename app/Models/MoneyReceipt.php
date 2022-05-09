<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyReceipt extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function admissionForm()
    {
        return $this->belongsTo(AdmissionForm::class, 'admission_id', 'id');
    }
}

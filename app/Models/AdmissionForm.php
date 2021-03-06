<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function moneyReceipt()
    {
        return $this->hasOne(MoneyReceipt::class, 'admission_id', 'id');
    }
}

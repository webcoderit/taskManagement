<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DueCollect extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function moneyReceipt()
    {
        return $this->belongsTo(MoneyReceipt::class, 'id', 'due_id');
    }
}

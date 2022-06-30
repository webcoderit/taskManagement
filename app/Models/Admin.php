<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
    {
        return $this->name;
    }
}

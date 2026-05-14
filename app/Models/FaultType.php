<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaultType extends Model
{
    protected $fillable = ['name', 'base_price', 'is_active'];
}

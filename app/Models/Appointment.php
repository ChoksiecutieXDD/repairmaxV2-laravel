<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tracking_code',
        'device_brand',
        'device_model',
        'fault_category',
        'description',
        'photo_path',
        'pref_date',
        'pref_time',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

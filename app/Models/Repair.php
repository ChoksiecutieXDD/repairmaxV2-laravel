<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tracking_code',
        'device_name',
        'issue_type',
        'status',
        'quote',
        'notes'
    ];

    // A repair belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

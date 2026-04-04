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
        'photo_paths',
        'pref_date',
        'pref_time',
        'status',
        'quote',
        'final_cost',
        'completion_notes',
        'invoice_number',
        'completed_at'
    ];

    protected function casts(): array
    {
        return [
            'pref_date' => 'date',
            'photo_paths' => 'array',
            'quote' => 'decimal:2',
            'final_cost' => 'decimal:2',
            'completed_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

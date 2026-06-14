<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentReschedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'rescheduled_by',
        'original_date',
        'new_date',
        'reason',
        'reschedule_type',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'original_date' => 'datetime',
            'new_date' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function rescheduledBy()
    {
        return $this->belongsTo(User::class, 'rescheduled_by');
    }
}

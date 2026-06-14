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
        'booking_number',
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
        'completed_at',
        'service_method',
        'address',
        'barangay',
        'city',
        'alt_address',
        'alt_barangay',
        'alt_city',
        'additional_fee',
        'pricing_confirmed',
        'service_cost',
        'parts_unit_price',
        'parts_cost',
        'total_cost',
        'profit',
        'cancellation_reason',
        'reschedule_count',
        'is_rescheduled'
    ];

    protected function casts(): array
    {
        return [
            'pref_date' => 'date',
            'photo_paths' => 'array',
            'quote' => 'decimal:2',
            'final_cost' => 'decimal:2',
            'service_cost' => 'decimal:2',
            'parts_unit_price' => 'decimal:2',
            'parts_cost' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'profit' => 'decimal:2',
            'completed_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'pricing_confirmed' => 'boolean',
            'is_rescheduled' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reschedules()
    {
        return $this->hasMany(AppointmentReschedule::class);
    }

    public function repairItems()
    {
        return $this->hasMany(RepairItem::class);
    }

    public function calculateProfit()
    {
        return $this->final_cost - ($this->service_cost + $this->parts_cost);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RepairItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'inventory_item_id',
        'quantity',
        'cost_price',
        'selling_price',
        'total_cost',
        'total_selling',
    ];

    protected function casts(): array
    {
        return [
            'cost_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'total_selling' => 'decimal:2',
        ];
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function inventoryItem()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function getProfitAttribute()
    {
        return $this->total_selling - $this->total_cost;
    }
}

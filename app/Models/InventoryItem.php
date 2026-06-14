<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'category',
        'sku',
        'quantity',
        'unit_price',
        'cost_price',
        'selling_price',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getTotalValueAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}

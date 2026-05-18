<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaultType extends Model
{
    protected $fillable = ['name', 'category', 'base_price', 'description', 'image_path', 'gallery_paths', 'is_active'];

    protected $casts = [
        'gallery_paths' => 'array',
    ];
}

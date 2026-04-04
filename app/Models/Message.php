<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'subject',
        'message',
        'is_read',
        'admin_read',
        'admin_read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'admin_read' => 'boolean',
        'admin_read_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}


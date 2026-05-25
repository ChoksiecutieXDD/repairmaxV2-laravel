<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    protected $fillable = ['chatbot_session_id', 'message', 'is_user', 'metadata'];

    protected $casts = [
        'is_user' => 'boolean',
        'metadata' => 'array',
    ];

    public function session()
    {
        return $this->belongsTo(ChatbotSession::class, 'chatbot_session_id');
    }

    /**
     * Scope to get only user messages
     */
    public function scopeUserMessages($query)
    {
        return $query->where('is_user', true);
    }

    /**
     * Scope to get only bot messages
     */
    public function scopeBotMessages($query)
    {
        return $query->where('is_user', false);
    }
}

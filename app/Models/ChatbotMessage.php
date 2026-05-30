<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotMessage extends Model
{
    protected $fillable = ['chatbot_session_id', 'message', 'is_user', 'metadata', 'role', 'content'];

    protected $casts = [
        'is_user' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Backward compatibility accessor for 'role'
     */
    public function getRoleAttribute()
    {
        return $this->is_user ? 'user' : 'assistant';
    }

    /**
     * Backward compatibility mutator for 'role'
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['is_user'] = ($value === 'user');
    }

    /**
     * Backward compatibility accessor for 'content'
     */
    public function getContentAttribute()
    {
        return $this->message;
    }

    /**
     * Backward compatibility mutator for 'content'
     */
    public function setContentAttribute($value)
    {
        $this->attributes['message'] = $value;
    }

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

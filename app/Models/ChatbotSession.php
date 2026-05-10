<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChatbotMessage;

class ChatbotSession extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function messages()
    {
        return $this->hasMany(ChatbotMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

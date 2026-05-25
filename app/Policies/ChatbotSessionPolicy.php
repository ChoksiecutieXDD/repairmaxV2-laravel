<?php

namespace App\Policies;

use App\Models\ChatbotSession;
use App\Models\User;

class ChatbotSessionPolicy
{
    /**
     * Determine if the user can view the session.
     */
    public function view(User $user, ChatbotSession $session): bool
    {
        return $user->id === $session->user_id;
    }

    /**
     * Determine if the user can delete the session.
     */
    public function delete(User $user, ChatbotSession $session): bool
    {
        return $user->id === $session->user_id;
    }

    /**
     * Determine if the user can update the session.
     */
    public function update(User $user, ChatbotSession $session): bool
    {
        return $user->id === $session->user_id;
    }
}

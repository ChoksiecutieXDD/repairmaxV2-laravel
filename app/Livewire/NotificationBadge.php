<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationBadge extends Component
{
    public $unreadCount = 0;
    public $type = 'user'; // 'user' or 'admin'

    public function mount($type = 'user')
    {
        $this->type = $type;
        $this->updateUnreadCount();
    }

    public function updateUnreadCount()
    {
        if (!Auth::check()) {
            $this->unreadCount = 0;
            return;
        }

        $userId = Auth::id();
        
        // Use user_id for regular users and admin_id for admin/staff
        // Based on the existing Notification model structure
        if ($this->type === 'admin') {
            $this->unreadCount = Notification::where('admin_id', $userId)
                ->where('is_read', false)
                ->count();
        } else {
            $this->unreadCount = Notification::where('user_id', $userId)
                ->where('is_read', false)
                ->count();
        }
    }

    public function render()
    {
        return <<<'HTML'
        <div wire:poll.30s="updateUnreadCount" class="inline-block">
            @if($unreadCount > 0)
                <span class="ml-auto inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-black text-white bg-red-500 rounded-full border border-gray-900 shadow-sm">
                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                </span>
            @endif
        </div>
        HTML;
    }
}

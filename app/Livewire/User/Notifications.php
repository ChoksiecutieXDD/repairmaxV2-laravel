<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Notification;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.user')]
#[Title('Notifications | Repairmax')]
class Notifications extends Component
{
    use WithPagination;

    public $filterRead = 'all';
    
    public function getNotifications()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = Notification::where('user_id', $user->id);

        if ($this->filterRead === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->filterRead === 'read') {
            $query->where('is_read', true);
        }

        return $query->latest()->paginate(15);
    }

    public function markAsRead(int|string $notificationId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->update(['is_read' => true]);
    }

    public function markAllAsRead()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('user_id', $user->id)
            ->update(['is_read' => true]);
    }

    public function deleteNotification(int|string $notificationId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->delete();
    }

    public function deleteAllNotifications()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('user_id', $user->id)->delete();
    }

    public function getIconForNotification(Notification $notification)
    {
        if (str_contains($notification->title, 'Repair')) {
            return 'build';
        } elseif (str_contains($notification->title, 'Appointment')) {
            return 'event';
        } elseif (str_contains($notification->title, 'Message')) {
            return 'mail';
        } elseif (str_contains($notification->title, 'Completed')) {
            return 'task_alt';
        }
        return 'notifications';
    }

    public function getColorForNotification(Notification $notification)
    {
        if (str_contains($notification->title, 'Completed')) {
            return 'text-green-500';
        } elseif (str_contains($notification->title, 'Cancelled')) {
            return 'text-red-500';
        } elseif (str_contains($notification->title, 'Pending')) {
            return 'text-yellow-500';
        }
        return 'text-blue-500';
    }

    public function getUnreadCount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        return Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
    }

    public function render()
    {
        return view('livewire.user.notifications', [
            'notifications' => $this->getNotifications(),
            'unreadCount' => $this->getUnreadCount(),
        ]);
    }
}

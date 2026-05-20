<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Notification;
use App\Models\Appointment;
use App\Models\Message;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.user')]
#[Title('Notifications | Repairmax')]
class Notifications extends Component
{
    use WithPagination;

    public $filterRead = 'all';
    public $search = '';
    public $selectedNotificationId;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterRead' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRead()
    {
        $this->resetPage();
    }
    
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

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('message', 'like', "%{$this->search}%");
            });
        }

        return $query->latest()->paginate(10);
    }

    public function selectNotification($notificationId)
    {
        $this->selectedNotificationId = $notificationId;
        $this->markAsRead($notificationId);
    }

    public function markAsRead(int|string $notificationId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        $this->dispatch('notification-updated');
    }

    public function markAllAsRead()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('user_id', $user->id)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        $this->dispatch('notification-updated');
        session()->flash('success', 'All notifications marked as read.');
    }

    public function deleteNotification(int|string $notificationId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('id', $notificationId)
            ->where('user_id', $user->id)
            ->delete();

        if ($this->selectedNotificationId == $notificationId) {
            $this->selectedNotificationId = null;
        }

        $this->dispatch('notification-updated');
        session()->flash('success', 'Notification deleted.');
    }

    public function deleteAllNotifications()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Notification::where('user_id', $user->id)->delete();
        $this->selectedNotificationId = null;

        $this->dispatch('notification-updated');
        session()->flash('success', 'All notifications deleted.');
    }

    public function getIconForNotification(Notification $notification)
    {
        $title = strtolower($notification->title);
        $type = strtolower($notification->type ?? '');

        if (str_contains($title, 'repair') || str_contains($title, 'completed') || str_contains($type, 'completed')) {
            return 'build_circle';
        } elseif (str_contains($title, 'appointment') || str_contains($type, 'appointment')) {
            return 'calendar_today';
        } elseif (str_contains($title, 'message') || str_contains($title, 'inquiry') || str_contains($type, 'message') || str_contains($type, 'inquiry')) {
            return 'mail';
        }
        return 'notifications';
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
        $notifications = $this->getNotifications();

        // Automatically select the first notification if none is selected and list is not empty
        if (!$this->selectedNotificationId && $notifications->count() > 0) {
            $this->selectedNotificationId = $notifications->first()->id;
            // Mark it as read
            $this->markAsRead($this->selectedNotificationId);
        }

        $selectedNotification = null;
        $relatedDetails = null;

        if ($this->selectedNotificationId) {
            $selectedNotification = Notification::where('user_id', auth()->id())->find($this->selectedNotificationId);
            if ($selectedNotification && $selectedNotification->related_model && $selectedNotification->related_id) {
                $model = strtolower($selectedNotification->related_model);
                if ($model === 'appointment') {
                    $relatedDetails = Appointment::where('user_id', auth()->id())->find($selectedNotification->related_id);
                } elseif ($model === 'message') {
                    $relatedDetails = Message::where('user_id', auth()->id())->find($selectedNotification->related_id);
                }
            }
        }

        return view('livewire.user.notifications', [
            'notifications' => $notifications,
            'unreadCount' => $this->getUnreadCount(),
            'selectedNotification' => $selectedNotification,
            'relatedDetails' => $relatedDetails,
        ]);
    }
}

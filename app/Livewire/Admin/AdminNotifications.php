<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Notification;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\User;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Admin Notifications | Repairmax')]
class AdminNotifications extends Component
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
        $query = Notification::where('admin_id', auth()->id());

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

    public function markAsRead($notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('admin_id', auth()->id())
            ->update(['is_read' => true]);
            
        $this->dispatch('notification-updated');
    }

    public function markAllAsRead()
    {
        Notification::where('admin_id', auth()->id())
            ->update(['is_read' => true]);
            
        $this->dispatch('notification-updated');
        
        session()->flash('success', 'All notifications marked as read.');
    }

    public function deleteNotification($notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('admin_id', auth()->id())
            ->delete();

        if ($this->selectedNotificationId == $notificationId) {
            $this->selectedNotificationId = null;
        }

        $this->dispatch('notification-updated');
        
        session()->flash('success', 'Notification deleted.');
    }

    public function deleteAllNotifications()
    {
        Notification::where('admin_id', auth()->id())->delete();
        $this->selectedNotificationId = null;
        $this->dispatch('notification-updated');
        
        session()->flash('success', 'All notifications deleted.');
    }

    public function getIconForNotification($notification)
    {
        $title = strtolower($notification->title);
        $type = strtolower($notification->type ?? '');
        
        if (str_contains($title, 'admin') || str_contains($type, 'admin')) {
            return 'shield';
        } elseif (str_contains($title, 'repair') || str_contains($title, 'completed') || str_contains($type, 'completed')) {
            return 'build_circle';
        } elseif (str_contains($title, 'appointment') || str_contains($type, 'appointment')) {
            return 'calendar_today';
        } elseif (str_contains($title, 'user') || str_contains($type, 'user')) {
            return 'person';
        } elseif (str_contains($title, 'message') || str_contains($title, 'inquiry') || str_contains($type, 'message') || str_contains($type, 'inquiry')) {
            return 'mail';
        } elseif (str_contains($title, 'inventory') || str_contains($type, 'inventory')) {
            return 'inventory_2';
        }
        return 'notifications';
    }

    public function getUnreadCount()
    {
        return Notification::where('admin_id', auth()->id())
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
            $selectedNotification = Notification::where('admin_id', auth()->id())->find($this->selectedNotificationId);
            if ($selectedNotification && $selectedNotification->related_model && $selectedNotification->related_id) {
                $model = strtolower($selectedNotification->related_model);
                if ($model === 'appointment') {
                    $relatedDetails = Appointment::with('user')->find($selectedNotification->related_id);
                } elseif ($model === 'message') {
                    $relatedDetails = Message::with('user')->find($selectedNotification->related_id);
                } elseif ($model === 'user') {
                    $relatedDetails = User::find($selectedNotification->related_id);
                }
            }
        }

        return view('livewire.admin.admin-notifications', [
            'notifications' => $notifications,
            'unreadCount' => $this->getUnreadCount(),
            'selectedNotification' => $selectedNotification,
            'relatedDetails' => $relatedDetails,
        ]);
    }
}

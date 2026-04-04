<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Notification;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Admin Notifications | Repairmax')]
class AdminNotifications extends Component
{
    use WithPagination;

    public $filterRead = 'all';
    public $filterType = 'all';
    public $search = '';
    
    public function getNotifications()
    {
        $query = Notification::where('admin_id', auth()->id());

        if ($this->filterRead === 'unread') {
            $query->where('is_read', false);
        } elseif ($this->filterRead === 'read') {
            $query->where('is_read', true);
        }

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%")
                  ->orWhere('message', 'like', "%{$this->search}%");
        }

        return $query->latest()->paginate(15);
    }

    public function markAsRead($notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('admin_id', auth()->id())
            ->update(['is_read' => true]);
    }

    public function markAllAsRead()
    {
        Notification::where('admin_id', auth()->id())
            ->update(['is_read' => true]);
    }

    public function deleteNotification($notificationId)
    {
        Notification::where('id', $notificationId)
            ->where('admin_id', auth()->id())
            ->delete();
    }

    public function deleteAllNotifications()
    {
        Notification::where('admin_id', auth()->id())->delete();
    }

    public function getIconForNotification($notification)
    {
        if (str_contains($notification->title, 'Admin')) {
            return 'person';
        } elseif (str_contains($notification->title, 'Repair')) {
            return 'build';
        } elseif (str_contains($notification->title, 'Appointment')) {
            return 'event';
        } elseif (str_contains($notification->title, 'Completed')) {
            return 'task_alt';
        } elseif (str_contains($notification->title, 'User')) {
            return 'group';
        }
        return 'notifications';
    }

    public function getUnreadCount()
    {
        return Notification::where('admin_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    public function navigateToRelated($notificationId)
    {
        $notification = Notification::find($notificationId);
        
        if (!$notification) {
            return;
        }

        // Mark as read
        $this->markAsRead($notificationId);

        // Navigate based on model type
        if ($notification->related_model && $notification->related_id) {
            $routes = [
                'appointment' => '/admin/appointment-management',
                'user' => '/admin/user-management',
                'message' => '/admin/messages',
                'inventory' => '/admin/inventory-management',
            ];

            $model = strtolower($notification->related_model);
            $route = $routes[$model] ?? '/admin/dashboard';
            
            return redirect($route);
        }

        return redirect('/admin/dashboard');
    }

    public function render()
    {
        return view('livewire.admin.admin-notifications', [
            'notifications' => $this->getNotifications(),
            'unreadCount' => $this->getUnreadCount(),
        ]);
    }
}

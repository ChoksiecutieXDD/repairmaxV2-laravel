<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Notifications | Repairmax')]
class Notifications extends Component
{
    public $notifications = [
        [
            'id' => 1,
            'title' => 'Repair Completed',
            'message' => 'Your iPhone 13 Pro is ready for pickup!',
            'time' => '10 mins ago',
            'is_read' => false,
            'icon' => 'task_alt',
            'color' => 'text-green-500',
            'bg' => 'bg-green-100'
        ],
        [
            'id' => 2,
            'title' => 'New Message',
            'message' => 'A technician replied to your ticket.',
            'time' => '1 hour ago',
            'is_read' => false,
            'icon' => 'chat',
            'color' => 'text-blue-500',
            'bg' => 'bg-blue-100'
        ],
        [
            'id' => 3,
            'title' => 'Appointment Confirmed',
            'message' => 'Drop-off scheduled for tomorrow.',
            'time' => '1 day ago',
            'is_read' => true,
            'icon' => 'event',
            'color' => 'text-gray-500',
            'bg' => 'bg-gray-100'
        ]
    ];

    public function markAllAsRead()
    {
        // Mark all as read logic here
        foreach ($this->notifications as &$notification) {
            $notification['is_read'] = true;
        }
    }

    public function render()
    {
        return view('livewire.user.notifications');
    }
}

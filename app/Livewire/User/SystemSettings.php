<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('System Settings | Repairmax')]
class SystemSettings extends Component
{
    // Notification Toggles
    public $email_updates = true;
    public $sms_notifications = true;
    public $marketing_offers = false;

    // Privacy Checkboxes
    public $share_history = true;
    public $analytics_tracking = false;

    // You can add a function here later to actually save these settings to the database
    public function saveSettings()
    {
        // session()->flash('success', 'Settings updated.');
    }

    public function render()
    {
        return view('livewire.user.system-settings');
    }
}

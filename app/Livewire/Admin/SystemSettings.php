<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('System Settings | Repairmax')]
class SystemSettings extends Component
{
    public $activeTab = 'settings';
    public $maintenanceMode = false;
    public $emailNotifications = true;
    public $dataBackup = true;
    public $autoBackupTime = '02:00';
    public $systemVersion = '1.0.0';

    public function toggleMaintenance()
    {
        $this->maintenanceMode = !$this->maintenanceMode;
    }

    public function toggleEmailNotifications()
    {
        $this->emailNotifications = !$this->emailNotifications;
    }

    public function toggleDataBackup()
    {
        $this->dataBackup = !$this->dataBackup;
    }

    public function saveSettings()
    {
        session()->flash('success', 'System settings updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.system-settings');
    }
}

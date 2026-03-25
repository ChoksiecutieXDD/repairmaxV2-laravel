<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('System Settings | Repairmax')]
class SystemSettings extends Component
{
    public $maintenanceMode = false;
    public $debugMode = false;
    public $cacheEnabled = true;
    public $backupFrequency = 'daily';

    public function render()
    {
        $systemInfo = [
            ['label' => 'Laravel Version', 'value' => '11.0'],
            ['label' => 'PHP Version', 'value' => '8.3+'],
            ['label' => 'Database', 'value' => 'MySQL 8.0'],
            ['label' => 'Server Time', 'value' => date('Y-m-d H:i:s')],
            ['label' => 'Disk Usage', 'value' => '45.2 GB / 100 GB'],
            ['label' => 'Memory Usage', 'value' => '2.8 GB / 8 GB'],
        ];

        return view('livewire.admin.system-settings', [
            'systemInfo' => $systemInfo,
        ]);
    }
}

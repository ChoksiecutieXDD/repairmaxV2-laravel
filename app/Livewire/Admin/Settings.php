<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Settings | Repairmax')]
class Settings extends Component
{
    public $companyName = 'Repairmax';
    public $companyEmail = 'admin@repairmax.com';
    public $companyPhone = '+63 (2) 1234-5678';
    public $businessHours = '9:00 AM - 6:00 PM';

    public function updateSettings()
    {
        // Handle settings update
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}

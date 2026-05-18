<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\FaultType;

#[Layout('layouts.user')]
class ServiceDetail extends Component
{
    public $service;
    public $relatedServices;

    public function mount($id)
    {
        $this->service = FaultType::findOrFail($id);
        $this->relatedServices = FaultType::where('id', '!=', $id)->inRandomOrder()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.user.service-detail')
            ->title($this->service->name . ' | Repairmax');
    }
}

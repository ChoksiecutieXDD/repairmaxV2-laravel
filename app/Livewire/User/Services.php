<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\FaultType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Services | Repairmax')]
class Services extends Component
{
    public $search = '';
    public $selectedCategory = 'all';

    public function render()
    {
        $query = FaultType::orderBy('name', 'asc');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        return view('livewire.user.services', [
            'services' => $query->get()
        ]);
    }
}

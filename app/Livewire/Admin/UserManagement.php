<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('User Management | Repairmax')]
class UserManagement extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field 
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortBy = $field;
    }

    public function render()
    {
        $users = User::when($this->searchTerm, function ($query) {
            $query->where('first_name', 'like', "%{$this->searchTerm}%")
                  ->orWhere('last_name', 'like', "%{$this->searchTerm}%")
                  ->orWhere('email', 'like', "%{$this->searchTerm}%");
        })
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate(10);

        return view('livewire.admin.user-management', [
            'users' => $users,
        ]);
    }
}

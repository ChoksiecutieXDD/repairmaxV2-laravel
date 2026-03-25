<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Inventory | Repairmax')]
class Inventory extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function render()
    {
        $inventory = [
            ['id' => 1, 'item' => 'iPhone Screen', 'category' => 'Parts', 'quantity' => 45, 'unit_price' => '₱800', 'total_value' => '₱36,000', 'status' => 'In Stock'],
            ['id' => 2, 'item' => 'Battery Pack', 'category' => 'Parts', 'quantity' => 120, 'unit_price' => '₱300', 'total_value' => '₱36,000', 'status' => 'In Stock'],
            ['id' => 3, 'item' => 'Charging Cable', 'category' => 'Accessories', 'quantity' => 5, 'unit_price' => '₱200', 'total_value' => '₱1,000', 'status' => 'Low Stock'],
            ['id' => 4, 'item' => 'Screen Protector', 'category' => 'Accessories', 'quantity' => 0, 'unit_price' => '₱150', 'total_value' => '₱0', 'status' => 'Out of Stock'],
        ];

        return view('livewire.admin.inventory', [
            'inventory' => $inventory,
        ]);
    }
}

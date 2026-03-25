<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Inventory Management | Repairmax')]
class InventoryManagement extends Component
{
    public $showAddForm = false;
    public $itemName = '';
    public $category = '';
    public $quantity = '';
    public $unitPrice = '';

    public function addItem()
    {
        // Handle item addition
        $this->showAddForm = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->itemName = '';
        $this->category = '';
        $this->quantity = '';
        $this->unitPrice = '';
    }

    public function render()
    {
        $inventory = [
            ['id' => 1, 'item' => 'iPhone Screen', 'category' => 'Parts', 'quantity' => 45, 'unit_price' => '₱800', 'reorder_level' => 20, 'supplier' => 'TechParts Co.'],
            ['id' => 2, 'item' => 'Battery Pack', 'category' => 'Parts', 'quantity' => 120, 'unit_price' => '₱300', 'reorder_level' => 50, 'supplier' => 'Power Supplies Inc.'],
            ['id' => 3, 'item' => 'Charging Cable', 'category' => 'Accessories', 'quantity' => 5, 'unit_price' => '₱200', 'reorder_level' => 30, 'supplier' => 'Cable World'],
        ];

        return view('livewire.admin.inventory-management', [
            'inventory' => $inventory,
        ]);
    }
}

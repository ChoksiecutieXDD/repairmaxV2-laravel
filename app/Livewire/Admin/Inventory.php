<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Inventory | Repairmax')]
class Inventory extends Component
{
    public function render()
    {
        $totalItems = \App\Models\InventoryItem::count();
        $lowStock = \App\Models\InventoryItem::where('quantity', '<=', 10)->count();
        $outOfStock = \App\Models\InventoryItem::where('quantity', '<=', 0)->count();
        $totalValue = \App\Models\InventoryItem::sum(\DB::raw('quantity * unit_price'));

        return view('livewire.admin.inventory', compact('totalItems', 'lowStock', 'outOfStock', 'totalValue'));
    }
}

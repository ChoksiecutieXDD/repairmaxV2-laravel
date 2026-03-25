<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Inventory Management | Repairmax')]
class InventoryManagement extends Component
{
    public $itemId;
    public $name;
    public $category;
    public $sku;
    public $quantity = 0;
    public $unit_price = 0;
    public $search = '';
    public $isEdit = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'nullable|string|max:255',
        'sku' => 'required|string|max:100|unique:inventory_items,sku',
        'quantity' => 'required|integer|min:0',
        'unit_price' => 'required|numeric|min:0',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->resetInventoryForm();
    }

    public function render()
    {
        $items = \App\Models\InventoryItem::when($this->search, function ($query) {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('category', 'like', '%'.$this->search.'%')
                ->orWhere('sku', 'like', '%'.$this->search.'%');
        })->orderBy('name')->get();

        return view('livewire.admin.inventory-management', compact('items'));
    }

    public function createItem()
    {
        $this->isEdit = false;
        $this->resetInventoryForm();
    }

    public function editItem($id)
    {
        $item = \App\Models\InventoryItem::findOrFail($id);
        $this->isEdit = true;
        $this->itemId = $id;
        $this->name = $item->name;
        $this->category = $item->category;
        $this->sku = $item->sku;
        $this->quantity = $item->quantity;
        $this->unit_price = $item->unit_price;
    }

    public function saveItem()
    {
        $rules = $this->rules;

        if ($this->isEdit) {
            $rules['sku'] = 'required|string|max:100|unique:inventory_items,sku,' . $this->itemId;
        }

        $data = $this->validate($rules);

        if ($this->isEdit) {
            $item = \App\Models\InventoryItem::findOrFail($this->itemId);
            $item->update($data);
            session()->flash('message', 'Inventory item updated successfully.');
        } else {
            \App\Models\InventoryItem::create($data);
            session()->flash('message', 'Inventory item added successfully.');
        }

        $this->resetInventoryForm();
        $this->isEdit = false;
    }

    public function deleteItem($id)
    {
        \App\Models\InventoryItem::findOrFail($id)->delete();
        session()->flash('message', 'Inventory item deleted successfully.');
    }

    private function resetInventoryForm()
    {
        $this->itemId = null;
        $this->name = '';
        $this->category = '';
        $this->sku = '';
        $this->quantity = 0;
        $this->unit_price = 0;
        $this->search = '';
    }
}

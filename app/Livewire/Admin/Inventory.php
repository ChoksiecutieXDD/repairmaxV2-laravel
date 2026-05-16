<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\InventoryItem;
use App\Models\Brand;
use App\Models\FaultType;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.admin')]
#[Title('Inventory | Repairmax')]
class Inventory extends Component
{
    public $activeTab = 'brand'; // 'brand', 'items', 'fault'
    public $search = '';
    
    // Modal & Form State
    public $showEditModal = false;
    public ?int $editingId = null;
    public $editingType = ''; // 'brand', 'item', 'fault'
    
    // Form Fields
    public $formName = '';
    public $formCategory = '';
    public $formSku = '';
    public $formQuantity = 0;
    public $formUnitPrice = 0;
    public ?int $formBrandId = null;
    public $formBasePrice = 0;
    public $formIsActive = true;

    protected function rules()
    {
        if ($this->editingType === 'brand') {
            return [
                'formName' => 'required|string|max:255|unique:brands,name,' . $this->editingId,
            ];
        } elseif ($this->editingType === 'item') {
            return [
                'formName' => 'required|string|max:255',
                'formBrandId' => 'nullable|exists:brands,id',
                'formSku' => 'required|string|max:100|unique:inventory_items,sku,' . $this->editingId,
                'formQuantity' => 'required|integer|min:0',
                'formUnitPrice' => 'required|numeric|min:0',
            ];
        } else { // fault
            return [
                'formName' => 'required|string|max:255|unique:fault_types,name,' . $this->editingId,
                'formBasePrice' => 'required|numeric|min:0',
            ];
        }
    }

    public function editRecord(string $type, ?int $id = null)
    {
        $this->resetForm();
        $this->editingType = $type;
        $this->editingId = $id ?: null;
        
        if ($this->editingId) {
            if ($type === 'brand') {
                $record = Brand::findOrFail($id);
                $this->formName = $record->name;
            } elseif ($type === 'item') {
                $record = InventoryItem::findOrFail($id);
                $this->formName = $record->name;
                $this->formBrandId = $record->brand_id;
                $this->formSku = $record->sku;
                $this->formQuantity = $record->quantity;
                $this->formUnitPrice = $record->unit_price;
            } else { // fault
                $record = FaultType::findOrFail($id);
                $this->formName = $record->name;
                $this->formBasePrice = $record->base_price;
            }
        }
        
        $this->showEditModal = true;
    }

    public function saveRecord()
    {
        $this->validate();

        if ($this->editingType === 'brand') {
            Brand::updateOrCreate(['id' => $this->editingId], ['name' => $this->formName]);
        } elseif ($this->editingType === 'item') {
            InventoryItem::updateOrCreate(['id' => $this->editingId], [
                'name' => $this->formName,
                'brand_id' => $this->formBrandId,
                'sku' => $this->formSku,
                'quantity' => $this->formQuantity,
                'unit_price' => $this->formUnitPrice,
            ]);
        } else { // fault
            FaultType::updateOrCreate(['id' => $this->editingId], [
                'name' => $this->formName,
                'base_price' => $this->formBasePrice,
            ]);
        }

        $this->showEditModal = false;
        $this->resetForm();
        session()->flash('message', 'Record updated successfully.');
    }

    public function deleteRecord(string $type, int $id)
    {
        if ($type === 'brand') {
            Brand::findOrFail($id)->delete();
        } elseif ($type === 'item') {
            InventoryItem::findOrFail($id)->delete();
        } else { // fault
            FaultType::findOrFail($id)->delete();
        }
        session()->flash('message', 'Record deleted successfully.');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->formName = '';
        $this->formBrandId = null;
        $this->formSku = '';
        $this->formQuantity = 0;
        $this->formUnitPrice = 0;
        $this->formBasePrice = 0;
    }

    public function render()
    {
        $brands = Brand::all();
        
        $query = null;
        if ($this->activeTab === 'brand') {
            $query = Brand::query();
        } elseif ($this->activeTab === 'items') {
            $query = InventoryItem::with('brand');
        } else {
            $query = FaultType::query();
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $records = $query->latest()->get();

        return view('livewire.admin.inventory', [
            'records' => $records,
            'brands' => $brands,
            'totalItems' => InventoryItem::count(),
            'lowStock' => InventoryItem::where('quantity', '<=', 10)->count(),
            'totalValue' => InventoryItem::sum(DB::raw('quantity * unit_price')),
        ]);
    }
}

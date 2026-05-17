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
    public $activeTab = 'brand'; // 'brand', 'models', 'items'
    public $search = '';
    public $sortOrder = 'latest'; // 'latest', 'alpha_asc', 'alpha_desc', 'stock_asc', 'stock_desc'
    
    // Modal & Form State
    public $showEditModal = false;
    public ?int $editingId = null;
    public $editingType = ''; // 'brand', 'model', 'item'
    
    public $showDeleteModal = false;
    public $deletingType = '';
    public ?int $deletingId = null;
    public $deletingName = '';
    
    // Form Fields
    public $formName = '';
    public $formCategory = '';
    public $formSku = '';
    public $formQuantity = 0;
    public $formUnitPrice = 0;
    public ?int $formBrandId = null;
    public $formIsActive = true;

    protected function rules()
    {
        if ($this->editingType === 'brand') {
            return [
                'formName' => 'required|string|max:255|unique:brands,name,' . $this->editingId,
            ];
        } elseif ($this->editingType === 'model') {
            return [
                'formName' => 'required|string|max:255',
                'formBrandId' => 'required|exists:brands,id',
            ];
        } else { // item
            return [
                'formName' => 'required|string|max:255',
                'formBrandId' => 'nullable|exists:brands,id',
                'formSku' => 'required|string|max:100|unique:inventory_items,sku,' . $this->editingId,
                'formQuantity' => 'required|integer|min:0',
                'formUnitPrice' => 'required|numeric|min:0',
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
            } elseif ($type === 'model') {
                $record = \App\Models\DeviceModel::findOrFail($id);
                $this->formName = $record->name;
                $this->formBrandId = $record->brand_id;
            } else { // item
                $record = InventoryItem::findOrFail($id);
                $this->formName = $record->name;
                $this->formBrandId = $record->brand_id;
                $this->formSku = $record->sku;
                $this->formQuantity = $record->quantity;
                $this->formUnitPrice = $record->unit_price;
            }
        }
        
        $this->showEditModal = true;
    }

    public function saveRecord()
    {
        $this->validate();

        if ($this->editingType === 'brand') {
            Brand::updateOrCreate(['id' => $this->editingId], ['name' => $this->formName]);
        } elseif ($this->editingType === 'model') {
            \App\Models\DeviceModel::updateOrCreate(['id' => $this->editingId], [
                'name' => $this->formName,
                'brand_id' => $this->formBrandId,
            ]);
        } else { // item
            InventoryItem::updateOrCreate(['id' => $this->editingId], [
                'name' => $this->formName,
                'brand_id' => $this->formBrandId,
                'sku' => $this->formSku,
                'quantity' => $this->formQuantity,
                'unit_price' => $this->formUnitPrice,
            ]);
        }

        $this->showEditModal = false;
        $this->resetForm();
        session()->flash('message', 'Record updated successfully.');
    }

    public function confirmDelete(string $type, int $id)
    {
        $this->deletingType = $type;
        $this->deletingId = $id;
        
        if ($type === 'brand') {
            $this->deletingName = Brand::find($id)?->name ?? '';
        } elseif ($type === 'model') {
            $this->deletingName = \App\Models\DeviceModel::find($id)?->name ?? '';
        } else {
            $this->deletingName = InventoryItem::find($id)?->name ?? '';
        }
        
        $this->showDeleteModal = true;
    }

    public function deleteRecord()
    {
        if ($this->deletingId) {
            if ($this->deletingType === 'brand') {
                Brand::findOrFail($this->deletingId)->delete();
            } elseif ($this->deletingType === 'model') {
                \App\Models\DeviceModel::findOrFail($this->deletingId)->delete();
            } else { // item
                InventoryItem::findOrFail($this->deletingId)->delete();
            }
            session()->flash('message', 'Record deleted successfully.');
        }

        $this->showDeleteModal = false;
        $this->deletingId = null;
        $this->deletingType = '';
        $this->deletingName = '';
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->formName = '';
        $this->formBrandId = null;
        $this->formSku = '';
        $this->formQuantity = 0;
        $this->formUnitPrice = 0;
    }

    public function render()
    {
        $brands = Brand::all();
        
        $query = null;
        if ($this->activeTab === 'brand') {
            $query = Brand::query();
        } elseif ($this->activeTab === 'models') {
            $query = \App\Models\DeviceModel::with('brand');
        } else {
            $query = InventoryItem::with('brand');
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply Sorting
        if ($this->sortOrder === 'alpha_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sortOrder === 'alpha_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sortOrder === 'stock_asc' && $this->activeTab === 'items') {
            $query->orderBy('quantity', 'asc');
        } elseif ($this->sortOrder === 'stock_desc' && $this->activeTab === 'items') {
            $query->orderBy('quantity', 'desc');
        } else {
            $query->latest();
        }

        $records = $query->get();

        return view('livewire.admin.inventory', [
            'records' => $records,
            'brands' => $brands,
            'totalItems' => InventoryItem::count(),
            'lowStock' => InventoryItem::where('quantity', '<=', 10)->count(),
            'totalValue' => InventoryItem::sum(DB::raw('quantity * unit_price')),
        ]);
    }
}

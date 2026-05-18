<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\FaultType;

#[Layout('components.layouts.admin')]
#[Title('Services | Repairmax')]
class Services extends Component
{
    use WithFileUploads;

    public string $search = '';
    public string $sortOrder = 'latest'; // 'latest', 'alpha_asc', 'alpha_desc', 'price_asc', 'price_desc'
    
    // Modal & Form State
    public bool $showEditModal = false;
    public ?int $editingId = null;
    
    // Form Fields
    public string $formName = '';
    public int|float $formBasePrice = 0;
    public string $formDescription = '';
    public mixed $formImage = null;
    public string $currentImage = '';
    public array $formGalleryImages = []; // Up to 5 additional images
    public array $currentGallery = []; // Saved gallery image paths

    protected function rules()
    {
        return [
            'formName' => 'required|string|max:255|unique:fault_types,name,' . $this->editingId,
            'formBasePrice' => 'required|numeric|min:0',
            'formDescription' => 'nullable|string|max:1000',
            'formImage' => 'nullable|image|max:2048', // 2MB Max
            'formGalleryImages.*' => 'nullable|image|max:2048', // 2MB Max per gallery image
        ];
    }

    public function editRecord(?int $id = null)
    {
        $this->resetForm();
        $this->editingId = $id ?: null;
        
        if ($this->editingId) {
            $record = FaultType::findOrFail($id);
            $this->formName = $record->name;
            $this->formBasePrice = $record->base_price;
            $this->formDescription = $record->description;
            $this->currentImage = $record->image_path;
            $this->currentGallery = $record->gallery_paths ?: [];
        }
        
        $this->showEditModal = true;
    }

    public function removeGalleryImage(int $index, bool $isCurrent = true)
    {
        if ($isCurrent) {
            if (isset($this->currentGallery[$index])) {
                unset($this->currentGallery[$index]);
                $this->currentGallery = array_values($this->currentGallery);
            }
        } else {
            if (isset($this->formGalleryImages[$index])) {
                unset($this->formGalleryImages[$index]);
                $this->formGalleryImages = array_values($this->formGalleryImages);
            }
        }
    }

    public function saveRecord()
    {
        $this->validate();

        $imagePath = $this->currentImage;
        if ($this->formImage) {
            $imagePath = 'storage/' . $this->formImage->store('services', 'public');
        }

        // Handle gallery images uploads (limit to total 5 maximum)
        $galleryPaths = $this->currentGallery ?: [];
        if (!empty($this->formGalleryImages)) {
            foreach ($this->formGalleryImages as $img) {
                if (count($galleryPaths) < 5) {
                    $galleryPaths[] = 'storage/' . $img->store('services', 'public');
                }
            }
        }

        FaultType::updateOrCreate(['id' => $this->editingId], [
            'name' => $this->formName,
            'base_price' => $this->formBasePrice,
            'description' => $this->formDescription,
            'image_path' => $imagePath,
            'gallery_paths' => $galleryPaths,
        ]);

        $this->showEditModal = false;
        session()->flash('message', 'Service saved successfully.');
    }

    public function deleteRecord(int $id)
    {
        FaultType::findOrFail($id)->delete();
        session()->flash('message', 'Service deleted successfully.');
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->formName = '';
        $this->formBasePrice = 0;
        $this->formDescription = '';
        $this->formImage = null;
        $this->currentImage = '';
        $this->formGalleryImages = [];
        $this->currentGallery = [];
    }

    public function render()
    {
        $query = FaultType::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Apply Sorting
        if ($this->sortOrder === 'alpha_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($this->sortOrder === 'alpha_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($this->sortOrder === 'price_asc') {
            $query->orderBy('base_price', 'asc');
        } elseif ($this->sortOrder === 'price_desc') {
            $query->orderBy('base_price', 'desc');
        } else {
            $query->latest();
        }

        $records = $query->get();

        return view('livewire.admin.services', [
            'records' => $records,
            'totalServices' => FaultType::count(),
            'avgPrice' => FaultType::avg('base_price') ?: 0,
            'overallPrice' => FaultType::sum('base_price') ?: 0,
        ]);
    }
}

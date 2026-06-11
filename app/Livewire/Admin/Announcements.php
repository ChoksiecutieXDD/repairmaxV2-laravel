<?php

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class Announcements extends Component
{
    use WithPagination;

    public $content = '';
    public $style = 'info';
    public $is_active = true;

    public $editingAnnouncementId = null;
    public $isEditMode = false;
    public $showModal = false;
    public $confirmingDeletionId = null;

    protected $rules = [
        'content' => 'required|string|max:5000',
        'style' => 'required|string|in:info,warning,success,danger',
        'is_active' => 'boolean',
    ];

    public function resetFields()
    {
        $this->content = '';
        $this->style = 'info';
        $this->is_active = true;
        $this->editingAnnouncementId = null;
        $this->isEditMode = false;
        $this->showModal = false;
        $this->confirmingDeletionId = null;
    }

    public function openCreateModal()
    {
        $this->resetFields();
        $this->showModal = true;
        $this->isEditMode = false;
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $announcement = Announcement::findOrFail($this->editingAnnouncementId);
            $announcement->update([
                'content' => $this->content,
                'style' => $this->style,
                'is_active' => $this->is_active,
            ]);
            session()->flash('message', 'Announcement updated successfully.');
        } else {
            // Deactivate other announcements if this one is active (optional, but keep it simple or allow multiple active)
            // For now, let's just create it.
            Announcement::create([
                'content' => $this->content,
                'style' => $this->style,
                'is_active' => $this->is_active,
            ]);
            session()->flash('message', 'Announcement created successfully.');
        }

        $this->resetFields();
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $this->editingAnnouncementId = $announcement->id;
        $this->content = $announcement->content;
        $this->style = $announcement->style;
        $this->is_active = $announcement->is_active;
        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function toggleStatus($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();
        session()->flash('message', 'Announcement status updated.');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeletionId = $id;
    }

    public function delete()
    {
        if ($this->confirmingDeletionId) {
            Announcement::destroy($this->confirmingDeletionId);
            session()->flash('message', 'Announcement deleted successfully.');
            $this->resetFields();
        }
    }

    public function cancelDelete()
    {
        $this->confirmingDeletionId = null;
    }

    public function render()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('livewire.admin.announcements', compact('announcements'))
            ->layout('components.layouts.admin', ['title' => 'Announcements Management']);
    }
}

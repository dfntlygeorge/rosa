<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class AddTaskModal extends Component
{
    public $showModal = false;

    // Form properties
    public $title = '';
    public $description = '';
    public $subject_id = '';
    public $priority = 'medium';
    public $due_date = '';
    public $due_time = '';
    public $xp_earned = 10; // Default XP

    // Hardcoded subjects for now
    public $subjects = [
        ['id' => 1, 'name' => 'Mathematics', 'color' => '#10b981'],
        ['id' => 2, 'name' => 'Science', 'color' => '#3b82f6'],
        ['id' => 3, 'name' => 'English', 'color' => '#f59e0b'],
        ['id' => 4, 'name' => 'History', 'color' => '#ef4444'],
        ['id' => 5, 'name' => 'Art', 'color' => '#8b5cf6'],
    ];

    protected $listeners = ['openCreateTaskModal' => 'openModal'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'subject_id' => 'required',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'required|date|after_or_equal:today',
        'due_time' => 'required',
        'xp_earned' => 'required|integer|min:1|max:100',
    ];

    public function openModal()
    {
        $this->showModal = true;
        // dd($this->showModal);
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->subject_id = '';
        $this->priority = 'medium';
        $this->due_date = '';
        $this->due_time = '';
        $this->xp_earned = 10;
    }

    public function createTask()
    {
        $this->validate();

        // TODO: Implement task creation logic
        // For now, just close the modal and show success message
        $this->closeModal();
        session()->flash('message', 'Task created successfully!');
    }
    public function render()
    {
        return view('livewire.dashboard.add-task-modal');
    }
}

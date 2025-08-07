<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use App\Models\Subject;
use Livewire\Component;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    // Subjects from database
    public $subjects = [];

    protected $listeners = ['openCreateTaskModal' => 'openModal'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'subject_id' => 'required|exists:subjects,id',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'required|date|after_or_equal:today',
        'due_time' => 'required',
        'xp_earned' => 'required|integer|min:1|max:100',
    ];

    protected $messages = [
        'title.required' => 'Task title is required.',
        'title.min' => 'Task title must be at least 3 characters.',
        'subject_id.required' => 'Please select a subject.',
        'subject_id.exists' => 'Selected subject is invalid.',
        'due_date.required' => 'Due date is required.',
        'due_date.after_or_equal' => 'Due date cannot be in the past.',
        'due_time.required' => 'Due time is required.',
        'xp_earned.required' => 'XP reward is required.',
        'xp_earned.min' => 'XP reward must be at least 1.',
        'xp_earned.max' => 'XP reward cannot exceed 100.',
    ];

    public function mount()
    {
        $this->loadSubjects();
    }

    public function loadSubjects()
    {
        $this->subjects = Subject::where('user_id', Auth::id())
            ->select('id', 'name', 'color')
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->resetForm();
        $this->loadSubjects(); // Refresh subjects in case they changed
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

        try {
            // Combine date and time into a single datetime
            $dueDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->due_date . ' ' . $this->due_time);

            // Create the task
            Task::create([
                'user_id' => Auth::id(),
                'subject_id' => $this->subject_id,
                'title' => $this->title,
                'description' => $this->description,
                'due_date' => $dueDateTime,
                'priority' => $this->priority,
                'xp_earned' => $this->xp_earned,
                'is_done' => false,
            ]);

            // Close modal and show success message
            $this->closeModal();

            // Flash success message
            session()->flash('message', 'Task created successfully!');
            session()->flash('message_type', 'success');

            // Emit event to refresh task list if needed
            $this->dispatch('taskCreated');
        } catch (Exception $e) {
            // Handle any errors
            session()->flash('message', 'Failed to create task. Please try again.');
            session()->flash('message_type', 'error');

            // Log the error for debugging
            Log::error('Task creation failed: ' . $e->getMessage());
        }

        return redirect()->route('dashboard');
    }

    // Helper method to get formatted subject options
    public function getSubjectOptions()
    {
        return collect($this->subjects)->mapWithKeys(function ($subject) {
            return [$subject['id'] => $subject['name']];
        });
    }

    public function render()
    {
        return view('livewire.dashboard.add-task-modal');
    }
}

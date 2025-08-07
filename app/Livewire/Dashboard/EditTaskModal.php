<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Task;
use App\Models\Subject;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EditTaskModal extends Component
{
    public $showModal = false;
    public $taskId;

    // Form properties
    public $title = '';
    public $description = '';
    public $subject_id = '';
    public $priority = 'medium';
    public $due_date = '';
    public $due_time = '';
    public $xp_earned = 10;

    // Subjects from database
    public $subjects = [];

    protected $listeners = ['openEditTaskModal' => 'openModal'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'subject_id' => 'required|exists:subjects,id',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'required|date',
        'due_time' => 'required',
        'xp_earned' => 'required|integer|min:1|max:100',
    ];

    protected $messages = [
        'title.required' => 'Task title is required.',
        'title.min' => 'Task title must be at least 3 characters.',
        'subject_id.required' => 'Please select a subject.',
        'subject_id.exists' => 'Selected subject is invalid.',
        'due_date.required' => 'Due date is required.',
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

    public function openModal($taskId)
    {
        $this->taskId = $taskId;
        $this->showModal = true;
        $this->loadSubjects(); // Refresh subjects in case they changed
        $this->loadTaskData();
    }

    public function loadTaskData()
    {
        try {
            $task = Task::with('subject')->where('user_id', Auth::id())->findOrFail($this->taskId);

            // Populate form with existing task data
            $this->title = $task->title;
            $this->subject_id = $task->subject_id;
            $this->priority = $task->priority;
            $this->due_date = $task->due_date->format('Y-m-d');
            $this->due_time = $task->due_date->format('H:i');
            $this->xp_earned = $task->xp_earned;
            $this->description = $task->description ?? '';
        } catch (Exception $e) {
            $this->closeModal();
            session()->flash('message', 'Task not found or access denied.');
            session()->flash('message_type', 'error');
            Log::error('Failed to load task data: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetErrorBag();
    }

    public function resetForm()
    {
        $this->taskId = null;
        $this->title = '';
        $this->description = '';
        $this->subject_id = '';
        $this->priority = 'medium';
        $this->due_date = '';
        $this->due_time = '';
        $this->xp_earned = 10;
    }

    public function updateTask()
    {
        $this->validate();

        try {
            $task = Task::where('user_id', Auth::id())->findOrFail($this->taskId);

            // Combine date and time into a single datetime
            $dueDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->due_date . ' ' . $this->due_time);

            // Update the task
            $task->update([
                'subject_id' => $this->subject_id,
                'title' => $this->title,
                'description' => $this->description,
                'due_date' => $dueDateTime,
                'priority' => $this->priority,
                'xp_earned' => $this->xp_earned,
            ]);

            // Close modal and show success message
            $this->closeModal();

            // Flash success message
            session()->flash('message', 'Task updated successfully!');
            session()->flash('message_type', 'success');

            // Emit event to refresh task list
            $this->dispatch('taskUpdated');
        } catch (Exception $e) {
            // Handle any errors
            session()->flash('message', 'Failed to update task. Please try again.');
            session()->flash('message_type', 'error');

            // Log the error for debugging
            Log::error('Task update failed: ' . $e->getMessage());
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
        return view('livewire.dashboard.edit-task-modal');
    }
}

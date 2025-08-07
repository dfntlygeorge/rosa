<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TaskItem extends Component
{
    public Task $task;
    public $isOverdue = false;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->isOverdue = $this->task->due_date < Carbon::now();
    }

    public function toggleMarkAsDone()
    {
        // Security check - ensure user owns the task
        if ($this->task->user_id !== Auth::id()) {
            return;
        }

        $this->task->is_done = !$this->task->is_done;
        $this->task->save();

        // Emit event to parent component to refresh data
        $this->dispatch('taskUpdated');
    }

    public function deleteTask()
    {
        try {
            // Security check - ensure user owns the task
            if ($this->task->user_id !== Auth::id()) {
                session()->flash('message', 'Access denied.');
                session()->flash('message_type', 'error');
                return;
            }

            // Soft delete by setting is_deleted to true
            $this->task->update(['is_deleted' => true]);

            // Emit event to parent component to refresh data
            $this->dispatch('taskUpdated');

            session()->flash('message', 'Task deleted successfully!');
            session()->flash('message_type', 'success');
        } catch (Exception $e) {
            session()->flash('message', 'Failed to delete task. Please try again.');
            session()->flash('message_type', 'error');
            Log::error('Task deletion failed: ' . $e->getMessage());
        }
    }

    public function getDueTimeProperty()
    {
        $now = Carbon::now();
        $dueDate = $this->task->due_date;

        if ($dueDate->isToday()) {
            $hoursLeft = $now->diffInHours($dueDate, false);
            if ($hoursLeft <= 0) {
                return 'Overdue';
            } elseif ($hoursLeft <= 4) {
                return $hoursLeft . 'h left';
            } else {
                return 'Today';
            }
        } elseif ($dueDate->isTomorrow()) {
            return 'Tomorrow';
        } elseif ($dueDate->isPast()) {
            return 'Overdue';
        } else {
            return $dueDate->format('M j');
        }
    }

    public function getPriorityConfigProperty()
    {
        return [
            'high' => ['icon' => '🔥', 'bg' => 'bg-red-600', 'text' => 'text-red-100'],
            'medium' => ['icon' => '🟡', 'bg' => 'bg-yellow-600', 'text' => 'text-yellow-100'],
            'low' => ['icon' => '🟢', 'bg' => 'bg-gray-600', 'text' => 'text-gray-100'],
        ];
    }

    public function getPriorityStyleProperty()
    {
        return $this->priorityConfig[$this->task->priority] ?? $this->priorityConfig['medium'];
    }

    public function render()
    {
        return view('livewire.dashboard.task-item');
    }
}

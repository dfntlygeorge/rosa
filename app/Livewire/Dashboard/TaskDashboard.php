<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TaskDashboard extends Component
{

    protected $listeners = ['deleteTask' => 'deleteTask'];
    public function toggleMarkAsDone($taskId)
    {
        $task = Task::where('user_id', Auth::id())
            ->where('id', $taskId)
            ->firstOrFail();

        $task->is_done = !$task->is_done;
        $task->save();
    }


    public function deleteTask($taskId)
    {
        try {
            $task = Task::where('user_id', Auth::id())
                ->where('id', $taskId)
                ->first();

            // dd($task->get());

            if (!$task) {
                session()->flash('message', 'Task not found or access denied.');
                session()->flash('message_type', 'error');
                return;
            }

            // Soft delete by setting is_deleted to true
            $task->update(['is_deleted' => true]);
            // dd("UPDATED NA");

            // Flash success message
            // session()->flash('message', 'Task deleted successfully!');
            // session()->flash('message_type', 'success');

            // Refresh the component to update the task lists
            // $this->render();
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            // Handle any errors
            session()->flash('message', 'Failed to delete task. Please try again.');
            session()->flash('message_type', 'error');

            // Log the error for debugging
            Log::error('Task deletion failed: ' . $e->getMessage());
        }
    }


    public function render()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $startOfDay = $now->copy()->startOfDay();
        $tomorrow = $now->copy()->addDay()->startOfDay();


        $tasksToday = Task::with('subject')
            ->where('user_id', $user->id)
            ->where('is_deleted', false)
            ->whereBetween('due_date', [$now, $now->copy()->endOfDay()])
            ->orderBy('due_date')
            ->get();

        $tasksRemaining = $tasksToday->count();


        $overdueTasks = Task::with('subject')
            ->where('user_id', $user->id)
            ->where('due_date', '<', $now)
            ->where('is_deleted', false)

            ->orderBy('due_date')
            ->get();

        $overdueTasksRemaining = $overdueTasks->count();
        $upcomingTasks = Task::with('subject')
            ->where('user_id', $user->id)
            ->where('due_date', '>=', $tomorrow)
            ->where('is_deleted', false)

            ->orderBy('due_date')
            ->get();

        $upcomingTasksCount = $upcomingTasks->count();

        $userLevel = 'Level 1'; // Replace this with your actual logic

        return view('livewire.dashboard.task-dashboard', [
            'user' => $user,
            'tasksRemaining' => $tasksRemaining,
            'userLevel' => $userLevel,
            'tasksToday' => $tasksToday,
            'overdueTasks' => $overdueTasks,
            'overdueTasksRemaining' => $overdueTasksRemaining,
            'upcomingTasks' => $upcomingTasks,
            'upcomingTasksCount' => $upcomingTasksCount,
        ]);
    }
}

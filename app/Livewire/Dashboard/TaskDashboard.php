<?php

namespace App\Livewire\Dashboard;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskDashboard extends Component
{


    public function render()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $startOfDay = $now->copy()->startOfDay();
        $tomorrow = $now->copy()->addDay()->startOfDay();


        $tasksToday = Task::with('subject')
            ->where('user_id', $user->id)
            ->whereBetween('due_date', [$now, $now->copy()->endOfDay()])
            ->where('is_done', false)
            ->orderBy('due_date')
            ->get();

        $tasksRemaining = $tasksToday->count();


        $overdueTasks = Task::with('subject')
            ->where('user_id', $user->id)
            ->where('due_date', '<', $now)
            ->where('is_done', false)
            ->orderBy('due_date')
            ->get();

        $overdueTasksRemaining = $overdueTasks->count();
        $upcomingTasks = Task::with('subject')
            ->where('user_id', $user->id)
            ->where('due_date', '>=', $tomorrow)
            ->where('is_done', false)
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

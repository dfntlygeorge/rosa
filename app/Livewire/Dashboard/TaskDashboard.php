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

        $tasksRemaining = Task::where('user_id', $user->id)
            ->whereDate('due_date', Carbon::today())
            ->where('is_done', false)
            ->count();
        $userLevel = 'Level 1'; // Replace this with your actual logic

        return view('livewire.dashboard.task-dashboard', [
            'user' => $user,
            'tasksRemaining' => $tasksRemaining,
            'userLevel' => $userLevel,
        ]);
    }
}

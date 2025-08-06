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
        return view('livewire.dashboard.task-dashboard');
    }
}

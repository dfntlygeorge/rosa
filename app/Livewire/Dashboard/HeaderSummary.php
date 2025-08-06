<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class HeaderSummary extends Component
{
    public $user;
    public $tasksRemaining;
    public $userLevel;

    public function mount($user, $tasksRemaining, $userLevel)
    {
        $this->user = $user;
        $this->tasksRemaining = $tasksRemaining;
        $this->userLevel = $userLevel;
    }

    public function getGreetingProperty()
    {
        $hour = now()->hour;
        // dd($hour);

        if ($hour < 12) {
            return 'Good morning';
        } elseif ($hour < 17) {
            return 'Good afternoon';
        } else {
            return 'Good evening';
        }
    }

    public function getStreakMessageProperty()
    {
        if ($this->user->streak == 0) {
            return 'Start your streak today!';
        } elseif ($this->user->streak == 1) {
            return '1-day streak!';
        } else {
            return $this->user->streak . '-day streak!';
        }
    }

    public function getTasksRemainingMessageProperty()
    {
        if ($this->tasksRemaining == 0) {
            return 'All done for today! 🎉';
        } elseif ($this->tasksRemaining == 1) {
            return 'You have 1 task remaining today';
        } else {
            return "You have {$this->tasksRemaining} tasks remaining today";
        }
    }

    public function render()
    {
        return view('livewire.dashboard.header-summary');
    }
}
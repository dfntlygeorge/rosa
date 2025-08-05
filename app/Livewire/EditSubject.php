<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class EditSubject extends Component
{
    public Subject $subject;
    public $name = '';
    public $professor = '';
    public $color = 'blue';
    public $unit_count = '';
    public $start_time = '';
    public $end_time = '';
    public $selected_days = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'professor' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:50',
        'unit_count' => 'nullable|integer|min:1|max:10',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'selected_days' => 'required|array|min:1',
    ];

    protected $messages = [
        'name.required' => 'Subject name is required.',
        'start_time.required' => 'Start time is required.',
        'end_time.required' => 'End time is required.',
        'end_time.after' => 'End time must be after start time.',
        'selected_days.required' => 'Please select at least one day.',
        'selected_days.min' => 'Please select at least one day.',
    ];

    public function mount(Subject $subject)
    {
        // Ensure the subject belongs to the authenticated user
        if ($subject->user_id !== Auth::id()) {
            abort(403);
        }

        $this->subject = $subject;
        $this->name = $subject->name;
        $this->professor = $subject->professor ?? '';
        $this->color = $subject->color ?? 'blue';
        $this->unit_count = $subject->unit_count ?? '';

        // Initialize schedule data if available
        if ($subject->schedule_info) {
            $this->start_time = $subject->schedule_info['start_time'] ?? '';
            $this->end_time = $subject->schedule_info['end_time'] ?? '';
            $this->selected_days = $subject->schedule_info['days'] ?? [];
        }
    }

    public function updatedSelectedDays()
    {
        // Ensure selected_days is always an array
        if (!is_array($this->selected_days)) {
            $this->selected_days = [];
        }
    }

    public function toggleDay($day)
    {
        if (in_array($day, $this->selected_days)) {
            $this->selected_days = array_values(array_diff($this->selected_days, [$day]));
        } else {
            $this->selected_days[] = $day;
        }
    }

    public function updateSubject()
    {
        $this->validate();

        // Prepare schedule info
        $scheduleInfo = [
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'days' => $this->selected_days,
            'formatted' => $this->formatSchedule()
        ];

        $this->subject->update([
            'name' => $this->name,
            'professor' => $this->professor ?: null,
            'color' => $this->color,
            'unit_count' => $this->unit_count ?: null,
            'schedule_info' => $scheduleInfo,
        ]);

        // Optionally redirect or emit event
        // return redirect()->route('subjects.index');
    }

    private function formatSchedule()
    {
        $timeRange = $this->formatTime($this->start_time) . '-' . $this->formatTime($this->end_time);
        $daysString = $this->formatDays($this->selected_days);

        return $timeRange . ' every ' . $daysString;
    }

    private function formatTime($time)
    {
        return \Carbon\Carbon::createFromFormat('H:i', $time)->format('g:iA');
    }

    private function formatDays($days)
    {
        if (empty($days)) return '';

        // Sort days by week order
        $weekOrder = ['M', 'T', 'W', 'Th', 'F', 'S', 'Su'];
        $sortedDays = array_intersect($weekOrder, $days);

        return implode('', $sortedDays);
    }

    public function render()
    {
        return view('livewire.edit-subject');
    }
}

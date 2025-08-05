<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// make the props here
class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'professor',
        'color',
        'unit_count',
        'schedule_info',
    ];

    protected $casts = [
        'schedule_info' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Helper method to get formatted schedule
    public function getFormattedScheduleAttribute(): string
    {
        if (!$this->schedule_info) {
            return 'No schedule set';
        }

        return $this->schedule_info['formatted'] ?? 'Invalid schedule format';
    }

    // Helper method to get days array
    public function getDaysAttribute(): array
    {
        return $this->schedule_info['days'] ?? [];
    }

    // Helper method to get start time
    public function getStartTimeAttribute(): ?string
    {
        return $this->schedule_info['start_time'] ?? null;
    }

    // Helper method to get end time
    public function getEndTimeAttribute(): ?string
    {
        return $this->schedule_info['end_time'] ?? null;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "subject_id",
        "title",
        "description",
        "due_date",
        "priority",
        "is_done",
        "completed_at",
        "xp_earned",
    ];
}

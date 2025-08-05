<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;

        $cmsc131 = Subject::where('name', 'like', 'CMSC 131%')->first();
        $cmsc110 = Subject::where('name', 'like', 'CMSC 110%')->first();

        if (!$cmsc131 || !$cmsc110) {
            $this->command->warn('Subjects not found. Make sure SubjectSeeder ran before this.');
            return;
        }

        // Tasks for CMSC 131
        Task::create([
            'user_id' => $userId,
            'subject_id' => $cmsc131->id,
            'title' => 'Read Chapter 3: CPU Architecture',
            'description' => 'Focus on register transfer and instruction cycle.',
            'due_date' => Carbon::now()->addDays(3),
            'priority' => 'high',
            'xp_earned' => 20,
        ]);

        Task::create([
            'user_id' => $userId,
            'subject_id' => $cmsc131->id,
            'title' => 'Assembly Programming Lab 1',
            'description' => 'Write and test your first program in MIPS.',
            'due_date' => Carbon::now()->addDays(5),
            'priority' => 'medium',
            'xp_earned' => 25,
        ]);

        // Tasks for CMSC 110
        Task::create([
            'user_id' => $userId,
            'subject_id' => $cmsc110->id,
            'title' => 'Create Static HTML Portfolio Site',
            'description' => 'Include at least 3 sections: About, Projects, Contact.',
            'due_date' => Carbon::now()->addDays(2),
            'priority' => 'high',
            'xp_earned' => 30,
        ]);

        Task::create([
            'user_id' => $userId,
            'subject_id' => $cmsc110->id,
            'title' => 'Watch Lecture: Intro to Web Security',
            'description' => null,
            'due_date' => Carbon::now()->addDays(4),
            'priority' => 'low',
            'xp_earned' => 10,
        ]);
    }
}

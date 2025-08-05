<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1; // Adjust based on your existing user, or use factory if needed

        Subject::create([
            'user_id' => $userId,
            'name' => 'CMSC 131 - Computer Organization and Assembly Language Programming',
            'professor' => 'Prof. Placeholder',
            'color' => '#1E90FF',
            'unit_count' => 3,
            'schedule_info' => json_encode([
                'days' => ['M', 'W', 'F'],
                'time' => '10:00 AM - 11:00 AM'
            ]),
        ]);

        Subject::create([
            'user_id' => $userId,
            'name' => 'CMSC 110 - Internet Technologies',
            'professor' => 'Prof. Placeholder',
            'color' => '#32CD32',
            'unit_count' => 3,
            'schedule_info' => json_encode([
                'days' => ['T', 'Th'],
                'time' => '1:00 PM - 3:00 PM (Lab)'
            ]),
        ]);
    }
}

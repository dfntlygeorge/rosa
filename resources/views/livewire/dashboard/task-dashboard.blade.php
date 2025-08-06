<div class="min-h-screen bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-4 space-y-4">

        <!-- Compact Header Summary -->
        @include('livewire.dashboard.header-summary')

        <!-- Quick Filters/Tabs - More Compact -->
        <div class="bg-gray-800 rounded-lg px-4 py-3">
            <div class="flex flex-wrap gap-2">
                <button class="px-3 py-1.5 bg-purple-600 text-white rounded-md text-xs font-medium">
                    All Tasks
                </button>
                <button
                    class="px-3 py-1.5 bg-gray-700 text-gray-300 rounded-md text-xs font-medium hover:bg-gray-600 transition-colors">
                    Today (3)
                </button>
                <button
                    class="px-3 py-1.5 bg-gray-700 text-gray-300 rounded-md text-xs font-medium hover:bg-gray-600 transition-colors">
                    High Priority
                </button>
                <button
                    class="px-3 py-1.5 bg-gray-700 text-gray-300 rounded-md text-xs font-medium hover:bg-gray-600 transition-colors">
                    Overdue (2)
                </button>
            </div>
        </div>

        <!-- Main Content Grid - 3 Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- Today's Tasks Column -->
            <div class="bg-gray-800 rounded-lg">
                <div class="px-4 py-3 border-b border-gray-700">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        📅 Today's Tasks
                        <span class="ml-2 text-xs bg-purple-600 text-white px-2 py-1 rounded-full">3</span>
                    </h2>
                </div>
                <div class="p-3 space-y-3">
                    <!-- TODO: Loop through today's tasks -->
                    @include('partials.task-item', [
                        'title' => 'Complete Database Assignment',
                        'subject' => 'CMSC 331',
                        'subjectColor' => 'blue',
                        'dueTime' => '4h left',
                        'priority' => 'high',
                        'xpEarned' => 50,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Read Chapter 5: Data Structures',
                        'subject' => 'CMSC 202',
                        'subjectColor' => 'green',
                        'dueTime' => '8h left',
                        'priority' => 'medium',
                        'xpEarned' => 25,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Submit Lab Report',
                        'subject' => 'CHEM 131',
                        'subjectColor' => 'red',
                        'dueTime' => '11:59 PM',
                        'priority' => 'low',
                        'xpEarned' => 30,
                    ])
                </div>
            </div>

            <!-- Overdue Tasks Column -->
            <div class="bg-red-900/20 border border-red-800 rounded-lg">
                <div class="px-4 py-3 border-b border-red-800">
                    <h2 class="text-lg font-bold text-red-400 flex items-center">
                        ⚠️ Overdue
                        <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">2</span>
                    </h2>
                </div>
                <div class="p-3 space-y-3">
                    <!-- TODO: Loop through overdue tasks -->
                    @include('partials.task-item', [
                        'title' => 'History Essay Draft',
                        'subject' => 'HIST 201',
                        'subjectColor' => 'yellow',
                        'dueTime' => '2d ago',
                        'priority' => 'high',
                        'xpEarned' => 75,
                        'isOverdue' => true,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Physics Problem Set 3',
                        'subject' => 'PHYS 161',
                        'subjectColor' => 'indigo',
                        'dueTime' => '1d ago',
                        'priority' => 'medium',
                        'xpEarned' => 40,
                        'isOverdue' => true,
                    ])
                </div>
            </div>

            <!-- Upcoming Tasks Column -->
            <div class="bg-gray-800 rounded-lg">
                <div class="px-4 py-3 border-b border-gray-700">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        📆 Upcoming
                        <span class="ml-2 text-xs bg-blue-600 text-white px-2 py-1 rounded-full">4</span>
                    </h2>
                </div>
                <div class="p-3 space-y-3 max-h-96 overflow-y-auto">
                    <!-- TODO: Loop through upcoming tasks -->
                    @include('partials.task-item', [
                        'title' => 'Midterm Exam Preparation',
                        'subject' => 'MATH 141',
                        'subjectColor' => 'purple',
                        'dueTime' => 'Tomorrow',
                        'priority' => 'high',
                        'xpEarned' => 100,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Programming Project',
                        'subject' => 'CMSC 201',
                        'subjectColor' => 'teal',
                        'dueTime' => 'Mar 15',
                        'priority' => 'medium',
                        'xpEarned' => 80,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Group Presentation',
                        'subject' => 'BMGT 380',
                        'subjectColor' => 'pink',
                        'dueTime' => 'Mar 18',
                        'priority' => 'medium',
                        'xpEarned' => 60,
                    ])

                    @include('partials.task-item', [
                        'title' => 'Literature Review',
                        'subject' => 'ENGL 101',
                        'subjectColor' => 'green',
                        'dueTime' => 'Mar 20',
                        'priority' => 'low',
                        'xpEarned' => 45,
                    ])
                </div>
            </div>

        </div>

        <!-- Compact Add Task Button -->
        @include('partials.add-task-button')

    </div>
</div>

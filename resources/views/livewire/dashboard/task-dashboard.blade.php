<div class="min-h-screen bg-gray-900 text-white">
    <div class="max-w-6xl mx-auto px-4 py-4 space-y-4">

        <!-- Compact Header Summary -->
        <livewire:dashboard.header-summary :user=$user :tasksRemaining=$tasksRemaining :userLevel=$userLevel />

        <!-- Quick Filters/Tabs - More Compact -->
        <div class="bg-gray-800 rounded-lg px-4 py-3">
            <div class="flex flex-wrap gap-2">
                <button class="px-3 py-1.5 bg-purple-600 text-white rounded-md text-xs font-medium">
                    All Tasks
                </button>
                <button
                    class="px-3 py-1.5 bg-gray-700 text-gray-300 rounded-md text-xs font-medium hover:bg-gray-600 transition-colors">
                    Today ({{ $tasksRemaining }})
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
                        <span
                            class="ml-2 text-xs bg-purple-600 text-white px-2 py-1 rounded-full">{{ $tasksRemaining }}</span>
                    </h2>
                </div>
                <div class="p-3 space-y-3">
                    @forelse($tasksToday as $task)
                        @include('partials.task-item', [
                            'title' => $task->title,
                            'subject' => $task->subject->name,
                            'subjectColor' => $task->subject->color ?? 'red',
                            'dueTime' => $task->due_date->diffForHumans(['parts' => 2, 'short' => true]), // e.g., "in 4h"
                            'priority' => $task->priority,
                            'xpEarned' => $task->xp_earned,
                        ])
                    @empty
                        <p class="text-purple-200 text-sm">No tasks due today! 🎉</p>
                    @endforelse
                </div>
            </div>

            <!-- Overdue Tasks Column -->
            <div class="bg-red-900/20 border border-red-800 rounded-lg">
                <div class="px-4 py-3 border-b border-red-800">
                    <h2 class="text-lg font-bold text-red-400 flex items-center">
                        ⚠️ Overdue
                        <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">
                            {{ $overdueTasksRemaining }}
                        </span>
                    </h2>
                </div>
                <div class="p-3 space-y-3">
                    @forelse ($overdueTasks as $task)
                        @include('partials.task-item', [
                            'title' => $task->title,
                            'subject' => $task->subject->name,
                            'subjectColor' => $task->subject->color ?? '#6b7280',
                            'dueTime' => $task->due_date->diffForHumans(['short' => true]),
                            'priority' => $task->priority,
                            'xpEarned' => $task->xp_earned,
                            'isOverdue' => true,
                        ])
                    @empty
                        <p class="text-sm text-red-300">You're all caught up! 🎉</p>
                    @endforelse
                </div>
            </div>


            <!-- Upcoming Tasks Column -->
            <div class="bg-gray-800 rounded-lg">
                <div class="px-4 py-3 border-b border-gray-700">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        📆 Upcoming
                        <span class="ml-2 text-xs bg-blue-600 text-white px-2 py-1 rounded-full">
                            {{ $upcomingTasksCount }}
                        </span>
                    </h2>
                </div>
                <div class="p-3 space-y-3 max-h-96 overflow-y-auto">
                    @forelse ($upcomingTasks as $task)
                        @include('partials.task-item', [
                            'title' => $task->title,
                            'subject' => $task->subject->name,
                            'subjectColor' => $task->subject->color ?? '#6b7280',
                            'dueTime' => $task->due_date->isTomorrow()
                                ? 'Tomorrow'
                                : $task->due_date->format('M j'),
                            'priority' => $task->priority,
                            'xpEarned' => $task->xp_earned,
                            'isOverdue' => false,
                        ])
                    @empty
                        <p class="text-sm text-gray-400">No upcoming tasks. You're ahead of the game! 🧠</p>
                    @endforelse
                </div>
            </div>


        </div>

        <!-- Compact Add Task Button -->
        @include('partials.add-task-button')

    </div>
</div>

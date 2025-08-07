<div class="min-h-screen bg-gray-900 text-white p-0">
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
            {{-- Today's Tasks Section --}}
            <div class="bg-gray-800 rounded-lg">
                <div class="px-4 py-3 border-b border-gray-700">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        🎯 Today's Tasks
                        <span class="ml-2 text-xs bg-green-600 text-white px-2 py-1 rounded-full">
                            {{ $tasksRemaining }}
                        </span>
                    </h2>
                </div>
                <div class="p-3 space-y-3 max-h-96 overflow-y-auto">
                    @forelse ($tasksToday as $task)
                        @livewire('dashboard.task-item', ['task' => $task], key('today-' . $task->id))
                    @empty
                        <p class="text-sm text-gray-400">No tasks for today. Time to relax! 🎉</p>
                    @endforelse
                </div>
            </div>

            <!-- Overdue Tasks Column -->
            <div class="bg-gray-800 rounded-lg">
                <div class="px-4 py-3 border-b border-gray-700">
                    <h2 class="text-lg font-bold text-white flex items-center">
                        ⚠️ Overdue
                        <span class="ml-2 text-xs bg-red-600 text-white px-2 py-1 rounded-full">
                            {{ $overdueTasksRemaining }}
                        </span>
                    </h2>
                </div>
                <div class="p-3 space-y-3 max-h-96 overflow-y-auto">
                    @forelse ($overdueTasks as $task)
                        @livewire('dashboard.task-item', ['task' => $task], key('overdue-' . $task->id))
                    @empty
                        <p class="text-sm text-gray-400">No overdue tasks. Great job staying on top of things! 👏</p>
                    @endforelse
                </div>
            </div>


            <!-- Upcoming Tasks Column -->
            {{-- Updated section using Livewire TaskItem component --}}
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
                        @livewire('dashboard.task-item', ['task' => $task], key($task->id))
                    @empty
                        <p class="text-sm text-gray-400">No upcoming tasks. You're ahead of the game! 🧠</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Compact Add Task Button -->
        @include('partials.add-task-button')

    </div>

    <!-- Create Task Modal Component -->
    <livewire:dashboard.add-task-modal />

    <!-- Edit Task Modal Component -->
    <livewire:dashboard.edit-task-modal />
</div>

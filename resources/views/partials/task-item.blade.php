{{-- Compact Task Item - receives: title, subject, subjectColor, dueTime, priority, xpEarned, isOverdue, taskId --}}

@php
    $priorityConfig = [
        'high' => ['icon' => '🔥', 'bg' => 'bg-red-600', 'text' => 'text-red-100'],
        'medium' => ['icon' => '🟡', 'bg' => 'bg-yellow-600', 'text' => 'text-yellow-100'],
        'low' => ['icon' => '🟢', 'bg' => 'bg-gray-600', 'text' => 'text-gray-100'],
    ];

    $priorityStyle = $priorityConfig[$priority] ?? $priorityConfig['medium'];
    $isOverdue = $isOverdue ?? false;
@endphp

<div
    class="bg-gray-700 rounded-lg p-3 hover:bg-gray-650 transition-colors {{ $isOverdue ? 'border-l-2 border-red-500' : '' }} relative group">
    <div class="flex items-start space-x-3">

        <!-- Compact Checkbox -->
        <button
            class="mt-0.5 w-4 h-4 rounded border border-gray-500 hover:border-purple-500 transition-colors flex items-center justify-center group">
            <svg class="w-2.5 h-2.5 text-transparent group-hover:text-purple-500 transition-colors" fill="currentColor"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>

        <!-- Task Content -->
        <div class="flex-1 min-w-0">

            <!-- Task Title - Single Line -->
            <h3 class="text-sm font-medium text-white truncate mb-1">{{ $title }}</h3>

            <!-- Subject & XP - Horizontal Layout -->
            <div class="flex items-center justify-between mb-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium"
                    style="background-color: {{ $subjectColor }}; color: white;">
                    {{ $subject }}
                </span>

                <span
                    class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-purple-600 text-purple-100">
                    +{{ $xpEarned }}
                </span>
            </div>

            <!-- Due Time & Priority - Bottom Row -->
            <div class="flex items-center justify-between text-xs">

                <!-- Due Time -->
                <span
                    class="{{ $isOverdue ? 'text-red-400 font-medium' : ($dueTime === '4h left' || $dueTime === '8h left' ? 'text-yellow-400' : 'text-gray-400') }}">
                    ⏰ {{ $dueTime }}
                </span>

                <!-- Priority Badge - Smaller -->
                <span
                    class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium {{ $priorityStyle['bg'] }} {{ $priorityStyle['text'] }}">
                    {{ $priorityStyle['icon'] }}
                </span>
            </div>
        </div>

        <!-- Actions Dropdown -->
        <div x-data="{ open: false }" class="relative opacity-0 group-hover:opacity-100 transition-opacity">

            <button @click="open = !open" class="p-1 rounded-md hover:bg-gray-600 transition-colors" type="button">
                <svg class="w-4 h-4 text-gray-400 hover:text-white transition-colors" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                    </path>
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.outside="open = false" x-transition
                class="absolute right-0 top-8 mt-1 w-32 bg-gray-800 rounded-md shadow-lg border border-gray-600 z-50">
                <div class="py-1">
                    <button
                        class="w-full text-left px-3 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors flex items-center space-x-2"
                        @click="$dispatch('openEditTaskModal', { taskId: {{ $task->id }} })">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <span>Edit</span>
                    </button>
                    {{-- <button
                        class="w-full text-left px-3 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white transition-colors flex items-center space-x-2"
                        @click="/* archiveTask() */">
                        <svg class="w-3 h-3" ...></svg>
                        <span>Archive</span>
                    </button> --}}
                    <!-- Updated Delete Button with correct Livewire v3 syntax -->
                    <button
                        class="w-full text-left px-3 py-2 text-sm text-red-400 hover:bg-red-900 hover:text-red-300 transition-colors flex items-center space-x-2"
                        @click="open = false;  $dispatch('deleteTask', { taskId: {{ $taskId ?? 0 }} })">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        <span>Delete</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

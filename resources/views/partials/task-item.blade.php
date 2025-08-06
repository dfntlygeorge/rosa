{{-- Compact Task Item - receives: title, subject, subjectColor, dueTime, priority, xpEarned, isOverdue --}}

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
    class="bg-gray-700 rounded-lg p-3 hover:bg-gray-650 transition-colors {{ $isOverdue ? 'border-l-2 border-red-500' : '' }}">
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
    </div>
</div>

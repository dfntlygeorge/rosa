<div class="max-w-2xl mx-auto">
    <div class="bg-gray-800 rounded-lg shadow-xl p-6">
        <h2 class="text-2xl font-bold text-white mb-6">Edit Subject</h2>

        <form wire:submit="updateSubject" class="space-y-6">
            <!-- Subject Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                    Subject Name
                </label>
                <input type="text" id="name" wire:model="name"
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors @error('name') border-red-500 @enderror"
                    placeholder="Enter subject name">
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Professor -->
            <div>
                <label for="professor" class="block text-sm font-medium text-gray-300 mb-2">
                    Professor
                </label>
                <input type="text" id="professor" wire:model="professor"
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors"
                    placeholder="Enter professor name">
            </div>

            <!-- Units -->
            <div>
                <label for="unit_count" class="block text-sm font-medium text-gray-300 mb-2">
                    Units
                </label>
                <input type="number" id="unit_count" wire:model="unit_count" min="1" max="10"
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors @error('unit_count') border-red-500 @enderror"
                    placeholder="Enter unit count">
                @error('unit_count')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subject Color -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Subject Color
                </label>
                <div class="relative" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white text-left flex items-center justify-between transition-colors">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full bg-{{ $color }}-500 mr-3"></div>
                            <span class="capitalize">{{ $color }}</span>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute top-full left-0 right-0 mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg z-10">
                        <div class="p-3 grid grid-cols-4 gap-3">
                            @foreach (['blue', 'red', 'green', 'yellow', 'purple', 'pink', 'indigo', 'teal'] as $colorOption)
                                <button type="button" wire:click="$set('color', '{{ $colorOption }}')"
                                    @click="open = false"
                                    class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors {{ $color === $colorOption ? 'bg-gray-600' : '' }}">
                                    <div class="w-8 h-8 rounded-full bg-{{ $colorOption }}-500 mb-1"></div>
                                    <span class="text-xs text-gray-300 capitalize">{{ $colorOption }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Schedule
                </label>

                <!-- Time Range -->
                <div class="mb-4">
                    <label class="block text-xs font-medium text-gray-400 mb-2">Time</label>
                    <div class="flex items-center space-x-3">
                        <input type="time" id="start_time" wire:model="start_time"
                            class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('start_time') border-red-500 @enderror">
                        <span class="text-gray-400">to</span>
                        <input type="time" id="end_time" wire:model="end_time"
                            class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('end_time') border-red-500 @enderror">
                    </div>
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Days Selection -->
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-2">Days</label>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $days = [
                                'M' => 'Monday',
                                'T' => 'Tuesday',
                                'W' => 'Wednesday',
                                'Th' => 'Thursday',
                                'F' => 'Friday',
                                'S' => 'Saturday',
                                'Su' => 'Sunday',
                            ];
                        @endphp

                        @foreach ($days as $dayCode => $dayName)
                            <button type="button" wire:click="toggleDay('{{ $dayCode }}')"
                                class="px-4 py-2 rounded-lg text-sm transition-colors {{ in_array($dayCode, $selected_days) ? 'bg-purple-600 text-white border-purple-600' : 'bg-gray-700 border-gray-600 text-gray-300 hover:bg-gray-600' }} border">
                                {{ $dayName }}
                            </button>
                        @endforeach
                    </div>
                    @error('selected_days')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ url()->previous() }}"
                    class="px-6 py-3 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors font-medium">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium disabled:opacity-50"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove>Update Subject</span>
                    <span wire:loading>Updating...</span>
                </button>
            </div>
        </form>
    </div>
</div>

@script
    <script>
        // Initialize Alpine.js data for dropdown functionality
        if (typeof Alpine !== 'undefined') {
            // Alpine is available, dropdown will work with x-data
        }
    </script>
@endscript

<!-- Edit Task Modal Backdrop -->
<div>
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            x-data="{ show: @entangle('showModal') }" x-show="show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" wire:click.self="closeModal">

            <!-- Modal Container -->
            <div class="bg-gray-800 rounded-lg shadow-2xl w-full max-w-md max-h-[90vh] overflow-y-auto"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Task
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 space-y-4">

                    <!-- General Error Message -->
                    @error('general')
                        <div class="bg-red-900/20 border border-red-800 rounded-lg p-3">
                            <p class="text-sm text-red-400">{{ $message }}</p>
                        </div>
                    @enderror

                    <!-- Task Title -->
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-2">Task Title *</label>
                        <input type="text" wire:model="title" placeholder="Enter task title..."
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subject Selection -->
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-2">Subject *</label>
                        <select wire:model="subject_id"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('subject_id') border-red-500 @enderror">
                            <option value="">Select a subject...</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject['id'] }}">{{ $subject['name'] }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority Selection -->
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-2">Priority</label>
                        <select wire:model="priority"
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors">
                            <option value="low">🟢 Low Priority</option>
                            <option value="medium">🟡 Medium Priority</option>
                            <option value="high">🔴 High Priority</option>
                        </select>
                    </div>

                    <!-- Due Date and Time -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-400 mb-2">Due Date *</label>
                            <input type="date" wire:model="due_date"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('due_date') border-red-500 @enderror">
                            @error('due_date')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-400 mb-2">Due Time *</label>
                            <input type="time" wire:model="due_time"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('due_time') border-red-500 @enderror">
                            @error('due_time')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- XP Earned -->
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-2">XP Reward</label>
                        <div class="flex items-center space-x-3">
                            <input type="number" wire:model="xp_earned" min="1" max="100"
                                class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors @error('xp_earned') border-red-500 @enderror">
                            <span class="text-purple-400 font-medium">XP</span>
                        </div>
                        @error('xp_earned')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-medium text-gray-400 mb-2">Description (Optional)</label>
                        <textarea wire:model="description" rows="3" placeholder="Add task details..."
                            class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 resize-none transition-colors @error('description') border-red-500 @enderror"></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-700">
                    <button wire:click="closeModal" class="px-4 py-2 text-gray-400 hover:text-white transition-colors">
                        Cancel
                    </button>
                    <button wire:click="updateTask"
                        class="px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        <span>Update Task</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

 <div class="max-w-2xl mx-auto">
     <div class="bg-gray-800 rounded-lg shadow-xl p-6">
         <h2 class="text-2xl font-bold text-white mb-6">Add New Subject</h2>

         <form class="space-y-6">
             <!-- Subject Name -->
             <div>
                 <label for="subject_name" class="block text-sm font-medium text-gray-300 mb-2">
                     Subject Name
                 </label>
                 <input type="text" id="subject_name"
                     class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors"
                     placeholder="Enter subject name">
             </div>

             <!-- Professor -->
             <div>
                 <label for="professor" class="block text-sm font-medium text-gray-300 mb-2">
                     Professor
                 </label>
                 <input type="text" id="professor"
                     class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors"
                     placeholder="Enter professor name">
             </div>

             <!-- Units -->
             <div>
                 <label for="units" class="block text-sm font-medium text-gray-300 mb-2">
                     Units
                 </label>
                 <input type="number" id="units" min="1" max="10"
                     class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white placeholder-gray-400 transition-colors"
                     placeholder="Enter unit count">
             </div>

             <!-- Subject Color -->
             <div>
                 <label class="block text-sm font-medium text-gray-300 mb-2">
                     Subject Color
                 </label>
                 <div class="relative">
                     <button type="button" id="colorDropdown"
                         class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white text-left flex items-center justify-between transition-colors"
                         onclick="toggleColorDropdown()">
                         <div class="flex items-center">
                             <div class="w-6 h-6 rounded-full bg-blue-500 mr-3" id="selectedColor"></div>
                             <span id="selectedColorText">Blue</span>
                         </div>
                         <svg class="w-5 h-5 text-gray-400 transition-transform" id="dropdownIcon" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                             </path>
                         </svg>
                     </button>

                     <div id="colorOptions"
                         class="absolute top-full left-0 right-0 mt-1 bg-gray-700 border border-gray-600 rounded-lg shadow-lg z-10 hidden">
                         <div class="p-3 grid grid-cols-4 gap-3">
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="blue" data-name="Blue">
                                 <div class="w-8 h-8 rounded-full bg-blue-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Blue</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="red" data-name="Red">
                                 <div class="w-8 h-8 rounded-full bg-red-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Red</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="green" data-name="Green">
                                 <div class="w-8 h-8 rounded-full bg-green-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Green</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="yellow" data-name="Yellow">
                                 <div class="w-8 h-8 rounded-full bg-yellow-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Yellow</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="purple" data-name="Purple">
                                 <div class="w-8 h-8 rounded-full bg-purple-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Purple</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="pink" data-name="Pink">
                                 <div class="w-8 h-8 rounded-full bg-pink-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Pink</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="indigo" data-name="Indigo">
                                 <div class="w-8 h-8 rounded-full bg-indigo-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Indigo</span>
                             </button>
                             <button type="button"
                                 class="color-option flex flex-col items-center p-2 rounded-lg hover:bg-gray-600 transition-colors"
                                 data-color="teal" data-name="Teal">
                                 <div class="w-8 h-8 rounded-full bg-teal-500 mb-1"></div>
                                 <span class="text-xs text-gray-300">Teal</span>
                             </button>
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
                         <input type="time" id="start_time"
                             class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors">
                         <span class="text-gray-400">to</span>
                         <input type="time" id="end_time"
                             class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white transition-colors">
                     </div>
                 </div>

                 <!-- Days Selection -->
                 <div>
                     <label class="block text-xs font-medium text-gray-400 mb-2">Days</label>
                     <div class="flex flex-wrap gap-2">
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="M">
                             Monday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="T">
                             Tuesday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="W">
                             Wednesday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="Th">
                             Thursday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="F">
                             Friday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="S">
                             Saturday
                         </button>
                         <button type="button"
                             class="day-btn px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-colors"
                             data-day="Su">
                             Sunday
                         </button>
                     </div>
                 </div>
             </div>

             <!-- Action Buttons -->
             <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                 <button type="button"
                     class="px-6 py-3 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors font-medium">
                     Cancel
                 </button>
                 <button type="submit"
                     class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                     Add Subject
                 </button>
             </div>
         </form>
     </div>
 </div>

 <script>
     // Color dropdown functionality
     function toggleColorDropdown() {
         const dropdown = document.getElementById('colorOptions');
         const icon = document.getElementById('dropdownIcon');

         dropdown.classList.toggle('hidden');
         icon.classList.toggle('rotate-180');
     }

     // Color selection
     document.querySelectorAll('.color-option').forEach(option => {
         option.addEventListener('click', function() {
             const color = this.dataset.color;
             const name = this.dataset.name;

             document.getElementById('selectedColor').className =
                 `w-6 h-6 rounded-full bg-${color}-500 mr-3`;
             document.getElementById('selectedColorText').textContent = name;

             toggleColorDropdown();
         });
     });

     // Day selection functionality
     document.querySelectorAll('.day-btn').forEach(btn => {
         btn.addEventListener('click', function() {
             this.classList.toggle('bg-purple-600');
             this.classList.toggle('text-white');
             this.classList.toggle('border-purple-600');
             this.classList.toggle('bg-gray-700');
             this.classList.toggle('text-gray-300');
             this.classList.toggle('border-gray-600');
         });
     });

     // Close dropdown when clicking outside
     document.addEventListener('click', function(event) {
         const dropdown = document.getElementById('colorDropdown');
         const options = document.getElementById('colorOptions');

         if (!dropdown.contains(event.target) && !options.contains(event.target)) {
             options.classList.add('hidden');
             document.getElementById('dropdownIcon').classList.remove('rotate-180');
         }
     });
 </script>

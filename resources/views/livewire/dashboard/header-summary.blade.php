<!-- Compact Header Summary -->
<div class="bg-gradient-to-r from-purple-800 to-purple-600 rounded-lg p-4 shadow-xl">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-3 lg:space-y-0">

        <!-- Welcome Message - More Compact -->
        <div class="flex-1">
            <h1 class="text-xl lg:text-2xl font-bold text-white mb-1">
                👋 Good evening, George!
            </h1>
            <p class="text-purple-100 text-sm">
                You have 3 tasks remaining today
            </p>
        </div>

        <!-- Stats Grid - Horizontal on Desktop -->
        <div class="flex lg:flex-row flex-wrap gap-3 lg:gap-4">

            <!-- XP & Level -->
            <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[80px]">
                <div class="text-lg font-bold text-white">1,250</div>
                <div class="text-purple-200 text-xs font-medium">XP</div>
                <div class="mt-1">
                    <span
                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500 text-yellow-900">
                        Lv 13
                    </span>
                </div>
            </div>

            <!-- Streak -->
            <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[80px]">
                <div class="text-lg font-bold text-white">🔥 7</div>
                <div class="text-purple-200 text-xs font-medium">Day streak</div>
            </div>

            <!-- Tasks Remaining -->
            <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2 text-center min-w-[80px]">
                <div class="text-lg font-bold text-white">3</div>
                <div class="text-purple-200 text-xs font-medium">Tasks left</div>
            </div>

        </div>
    </div>

    <!-- Compact Progress Bar -->
    <div class="mt-3">
        <div class="flex items-center justify-between text-xs text-purple-200 mb-1">
            <span>Level 13 Progress</span>
            <span>50/100 XP</span>
        </div>
        <div class="w-full bg-white/20 rounded-full h-1.5">
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-1.5 rounded-full transition-all duration-300"
                style="width: 50%"></div>
        </div>
    </div>
</div>

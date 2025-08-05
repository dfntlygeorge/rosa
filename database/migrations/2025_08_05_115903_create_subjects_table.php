<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('professor')->nullable();
            $table->string('color')->nullable(); // Could store hex (#ff0000) or Tailwind class (bg-red-500)
            $table->unsignedTinyInteger('unit_count')->nullable(); // If you ever calculate GPA weight
            $table->json('schedule_info')->nullable(); // e.g. { "days": ["M", "W", "F"], "time": "10:00-11:00 AM" }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

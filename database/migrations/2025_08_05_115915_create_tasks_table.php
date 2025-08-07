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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            $table->dateTime('due_date');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->boolean('is_done')->default(false);
            $table->timestamp('completed_at')->nullable();

            $table->unsignedInteger('xp_earned')->default(0);
            $table->boolean('is_deleted')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

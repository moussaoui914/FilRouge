<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('shift_start');
            $table->time('shift_end');
            $table->string('sector')->nullable();
            $table->text('tasks')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'absent'])->default('scheduled');
            $table->timestamps();
            
            $table->unique(['user_id', 'date']);
            $table->index(['date', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_schedules');
    }
};
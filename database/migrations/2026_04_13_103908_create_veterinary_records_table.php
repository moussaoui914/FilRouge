<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('veterinary_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained()->onDelete('cascade');
            $table->foreignId('veterinarian_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('record_date');
            $table->enum('type', ['checkup', 'vaccination', 'treatment', 'surgery', 'emergency']);
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->string('medication')->nullable();
            $table->string('dosage')->nullable();
            $table->timestamp('next_appointment')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->timestamps();
            
            $table->index(['animal_id', 'record_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('veterinary_records');
    }
};
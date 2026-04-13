<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('habitat_id')->constrained()->onDelete('cascade');
            $table->foreignId('maintainer_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('maintenance_date');
            $table->enum('type', ['cleaning', 'repair', 'inspection', 'renovation']);
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['habitat_id', 'maintenance_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
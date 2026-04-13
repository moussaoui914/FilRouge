<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species');
            $table->date('birth_date')->nullable();
            $table->enum('health_status', ['Excellent', 'Good', 'Fair', 'Poor', 'Critical'])->default('Good');
            $table->foreignId('habitat_id')->nullable()->constrained('habitats')->onDelete('set null');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
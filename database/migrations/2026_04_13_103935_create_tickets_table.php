<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name');
            $table->string('visitor_email');
            $table->enum('ticket_type', ['adult', 'child', 'senior', 'group', 'vip']);
            $table->decimal('price', 8, 2);
            $table->timestamp('purchase_date');
            $table->date('visit_date');
            $table->string('qr_code')->unique();
            $table->enum('status', ['active', 'used', 'expired', 'cancelled'])->default('active');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
            
            $table->index(['visit_date', 'status']);
            $table->index('qr_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
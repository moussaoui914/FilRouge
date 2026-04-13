<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mettre à jour les rôles possibles
            $table->enum('role', ['admin', 'responsable', 'soigneur', 'veterinaire', 'billetterie', 'maintenance', 'user'])
                  ->default('user')
                  ->change();
            
            // Ajouter des champs supplémentaires pour le personnel
            $table->string('phone')->nullable()->after('email');
            $table->text('address')->nullable()->after('phone');
            $table->string('specialization')->nullable()->after('address');
            $table->date('hire_date')->nullable()->after('specialization');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'user'])->default('user')->change();
            $table->dropColumn(['phone', 'address', 'specialization', 'hire_date']);
        });
    }
};
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
        Schema::table('users', function (Blueprint $table) {
            // Cambiar la columna 'role' a un enum con los valores correctos
            $table->enum('role', ['admin', 'user', 'cliente'])->default('user')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revertir si es necesario
            $table->enum('role', ['admin', 'user', 'cliente'])->default('user')->change();
        });
    }
};

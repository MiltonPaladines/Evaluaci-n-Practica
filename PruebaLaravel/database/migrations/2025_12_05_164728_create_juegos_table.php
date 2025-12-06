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
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion-corta')->nullable();
            $table->text('descripcion-larga')->nullable();
            //Precio normal y de oferta
            $table->decimal('precio-normal',8,2)->nullable(); //8 digitos, 2 decimales
            $table->decimal('precio-oferta',8,2)->nullable();

            //Firebase Storage URL
            $table->string('imagen_url', 500)->nullable();
            //Estatus del juego
            $table->boolean('destacado')->default(false);
            $table->boolean('activo')->default(true);
            //Relaciones
            $table->foreignId('plataforma_id')
            ->nullable()
            ->constrained('plataformas')
            ->nullOnDelete('set null');



            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};

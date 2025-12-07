<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plataforma;
use App\Models\Genero;
use App\Models\Juego;

class DatabaseSeeder extends Seeder

{   
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Crear Plataformas
        $pc = Plataforma::create(['nombre' => 'PC', 'slug' => 'pc']);
        $ps5 = Plataforma::create(['nombre' => 'PlayStation 5', 'slug' => 'ps5']);

        // 2. Crear Géneros
        $accion = Genero::create(['nombre' => 'Acción', 'slug' => 'accion']);
        $rpg = Genero::create(['nombre' => 'RPG', 'slug' => 'rpg']);

        // 3. Crear Juego vinculado
        $juego = Juego::create([
            'titulo' => 'The Legend of Laravel',
            'descripcion_corta' => 'Aprende backend jugando',
            'precio_normal' => 50.00,
            'plataforma_id' => $pc->id, // Usamos el ID del objeto creado arriba
            'activo' => true
        ]);

        // 4. Vincular géneros (Tabla Pivote)
        // Esto prueba que la relación N:N funciona
        $juego->generos()->attach([$accion->id, $rpg->id]);

        // 5. Usuario Admin
        User::create([
            'name' => 'Profesor',
            'email' => 'profe@gamezone.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genero extends Model
{
    use HasFactory;
    //Mapeo  tabla
    protected $table = 'generos';

    //Asignacion
    protected $fillable = ['nombre','slug',];   

    //Relaciones muchos a muchos
    public function juegos(){
        
        return $this->belongsToMany(Juego::class, 'juego_genero', 'genero_id', 'juego_id');
    }
}

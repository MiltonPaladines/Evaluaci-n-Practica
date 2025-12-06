<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plataforma extends Model
{
    use HasFactory;
    //Mapeo  tabla
    protected $table = 'plataformas';

    //Asignacion
    protected $fillable = ['nombre','slug',];   
    //Relaciones uno a muchos
    public function juegos(){
        return $this->hasMany(Juego::class, 'plataforma_id');
    }
}

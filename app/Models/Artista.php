<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;
protected $table = 'artistas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'genero_musical',
        'pais_origen',
    ];

    // --- RELACIONES ---

    /**
     * Un artista puede participar en muchos eventos (y viceversa) - Relación Muchos a Muchos.
     */
    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'eventos_artistas')
                    ->withPivot('rol')
                    ->withTimestamps();
    }
}

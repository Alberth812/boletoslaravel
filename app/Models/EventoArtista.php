<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot; // Importante usar Pivot

class EventoArtista extends Pivot // Extiende Pivot en lugar de Model
{
    use HasFactory;
    

    // Indica que esta es una tabla pivote
    public $incrementing = true; // Si tiene su propia clave primaria 'id'
    protected $table = 'eventos_artistas';

    protected $fillable = [
        'evento_id',
        'artista_id',
        'rol',
    ];

    // --- RELACIONES ---
    // Como es una pivote, normalmente no se definen relaciones aquí,
    // pero puedes hacerlo si necesitas acceder a los modelos relacionados desde la pivote.

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function artista()
    {
        return $this->belongsTo(Artista::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    Protected $table = 'eventos'; 

    protected $fillable = [
        'nombre',
        'descripcion',
        'inicio',
        'fin',
        'id_ubicacion',
        'lugar',
        'ciudad',
        'pais',
        'imagen',
        'estado',
    ];

    protected $casts = [
        'inicio' => 'datetime',
        'fin' => 'datetime',
    ];

    // --- RELACIONES ---

    /**
     * Un evento pertenece a una ubicación.
     */
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    /**
     * Un evento puede tener muchos artistas (y viceversa) - Relación Muchos a Muchos.
     */
    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'eventos_artistas')
                    ->withPivot('rol') // Incluye la columna 'rol' de la tabla pivote
                    ->withTimestamps();
    }

    /**
     * Un evento puede tener muchas compras.
     */
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    /**
     * Un evento puede tener muchos boletos vendidos.
     */
    public function boletos()
    {
        return $this->hasMany(Boleto::class);
    }

    /**
     * Tipos de boletos disponibles para este evento.
     * (Si hay una tabla intermedia o es directa, ajusta según tu diseño)
     * Asumo relación directa por ahora.
     */
    public function tiposDeBoletos()
    {
        return $this->hasMany(TipoDeBoleto::class); // O belongsToMany si es N:M
    }
}

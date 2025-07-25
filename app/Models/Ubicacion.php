<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'pais',
        'capacidad',
    ];

    // --- RELACIONES ---

    /**
     * Una ubicación puede albergar muchos eventos.
     */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'id_ubicacion');
    }
}

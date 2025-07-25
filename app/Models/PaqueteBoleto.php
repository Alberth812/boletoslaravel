<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaqueteBoleto extends Model
{
    use HasFactory;

    protected $table = 'paquetes_boletos'; 
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'cantidad_boletos',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    // --- RELACIONES ---
    // Las relaciones de paquetes pueden ser más complejas dependiendo de cómo
    // se implemente la lógica de compra (por ejemplo, si un paquete incluye
    // tipos específicos de boletos). Por ahora, se deja simple.

    /**
     * Un paquete puede estar asociado a muchos tipos de boletos.
     * (Relación N:M, necesitarías una tabla pivote adicional si es compleja)
     * Asumo una relación simple por ahora.
     */
    // public function tiposDeBoletos()
    // {
    //     return $this->belongsToMany(TipoDeBoleto::class, 'paquete_tipo_boleto'); // Tabla pivote hipotética
    // }
}

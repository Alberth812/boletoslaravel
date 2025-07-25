<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;
    protected $table = 'descuentos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'porcentaje',
        'monto_fijo',
        'fecha_inicio',
        'fecha_fin',
        'usos_maximos',
        'usos_actuales',
        'activo',
    ];

    protected $casts = [
        'porcentaje' => 'decimal:2',
        'monto_fijo' => 'decimal:2',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'activo' => 'boolean',
    ];

    // --- RELACIONES ---

    /**
     * Un descuento puede haber sido aplicado en muchas compras (y viceversa).
     * Relación Muchos a Muchos a través de la tabla pivote 'compra_descuentos'.
     */
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_descuentos')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}

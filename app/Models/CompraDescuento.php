<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CompraDescuento extends Pivot
{
    use HasFactory;

    public $incrementing = true;
    protected $table = 'compra_descuentos';

    protected $fillable = [
        'compra_id',
        'descuento_id',
        'monto_aplicado',
    ];

    protected $casts = [
        'monto_aplicado' => 'decimal:2',
    ];

    // --- RELACIONES ---
    // Similar a EventoArtista, normalmente no se definen aquí, pero puedes hacerlo.

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function descuento()
    {
        return $this->belongsTo(Descuento::class);
    }
}

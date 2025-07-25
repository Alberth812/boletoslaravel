<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleto extends Model
{
    use HasFactory;
protected $table = 'boletos';

    protected $fillable = [
        'compra_id',
        'tipo_boleto_id',
        'evento_id',
        'numero_serie',
        'qr_code',
        'asiento',
        'precio',
        'estado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
    ];

    // --- RELACIONES ---

    /**
     * Un boleto pertenece a una compra.
     */
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    /**
     * Un boleto es de un tipo específico.
     */
    public function tipoBoleto()
    {
        return $this->belongsTo(TipoDeBoleto::class, 'tipo_boleto_id');
    }

    /**
     * Un boleto es para un evento específico.
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}

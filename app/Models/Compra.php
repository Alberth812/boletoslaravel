<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
protected $table = 'compras';
    protected $fillable = [
        'usuario_id',
        'evento_id',
        'fecha_compra',
        'total',
        'metodo_pago',
        'estado',
        'numero_confirmacion',
    ];

    protected $casts = [
        'fecha_compra' => 'datetime',
        'total' => 'decimal:2',
    ];

    // --- RELACIONES ---

    /**
     * Una compra pertenece a un usuario.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Una compra pertenece a un evento.
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    /**
     * Una compra puede incluir muchos boletos.
     */
    public function boletos()
    {
        return $this->hasMany(Boleto::class, 'compra_id');
    }

    /**
     * Una compra puede tener muchos descuentos aplicados (y viceversa).
     * Relación Muchos a Muchos a través de la tabla pivote 'compra_descuentos'.
     */
    public function descuentos()
    {
        return $this->belongsToMany(Descuento::class, 'compra_descuentos')
                    ->withPivot('monto_aplicado')
                    ->withTimestamps();
    }
}

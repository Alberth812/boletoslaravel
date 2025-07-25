<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeBoleto extends Model
{
    use HasFactory;

    protected $table = 'tipos_de_boletos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_base',
        'zona_asiento',
    ];

    protected $casts = [
        'precio_base' => 'decimal:2',
    ];

    // --- RELACIONES ---

    /**
     * Un tipo de boleto puede ser usado en muchos boletos vendidos.
     */
    public function boletos()
    {
        return $this->hasMany(Boleto::class, 'tipo_boleto_id');
    }

    /**
     * Un tipo de boleto pertenece a un evento.
     * (Ajusta según tu diseño real - podría ser N:M)
     */
    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }
}

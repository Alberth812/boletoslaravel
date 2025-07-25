<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'nombre_usuario',
        'correo',
        'contraseña_hash',
        'nombre',
        'apellido',
        'telefono',
        'fecha_nacimiento',
        'es_admin',
        'esta_activo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'contraseña_hash', // Cambiado de 'password' a 'contraseña_hash'
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'correo_verified_at' => 'datetime', // Puede que no lo uses si no verificas correos
            'fecha_nacimiento' => 'date', // Casting para fecha de nacimiento
            'es_admin' => 'boolean',
            'esta_activo' => 'boolean',
            'contraseña_hash' => 'hashed', // Asegura que se maneje como un hash
        ];
    }

    // --- RELACIONES ---

    /**
     * Un usuario puede tener muchas compras.
     */
    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class, 'usuario_id');
    }
}
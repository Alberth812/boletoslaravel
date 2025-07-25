<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Evento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $metodos = ['Tarjeta', 'PayPal', 'Transferencia', 'Bizum'];
        $estados = ['Completada', 'Pendiente', 'Cancelada', 'Reembolsada'];

        $fecha_compra = fake()->dateTimeBetween('-2 months', 'now');

        return [
            // 'usuario_id' y 'evento_id' se asignarán en el seeder
            'fecha_compra' => $fecha_compra,
            'total' => fake()->randomFloat(2, 20, 2000),
            'metodo_pago' => fake()->randomElement($metodos),
            'estado' => fake()->randomElement($estados),
            'numero_confirmacion' => fake()->unique()->regexify('CONF-[A-Z0-9]{6}'),
        ];
    }
}

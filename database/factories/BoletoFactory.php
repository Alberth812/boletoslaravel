<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Compra;
use App\Models\TipoDeBoleto;
use App\Models\Evento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boleto>
 */
class BoletoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $estados = ['Activo', 'Usado', 'Cancelado', 'Reservado'];

        return [
            // 'compra_id', 'tipo_boleto_id', 'evento_id' se asignarán en el seeder
            'numero_serie' => fake()->unique()->regexify('TKT-[A-Z]{2}[0-9]{6}'),
            'qr_code' => 'qrcodes/' . fake()->uuid() . '.png', // Solo nombre de archivo
            'asiento' => fake()->optional(0.8)->regexify('[A-Z][0-9]{1,3}'), // 80% tienen asiento
            'precio' => fake()->randomFloat(2, 20, 500),
            'estado' => fake()->randomElement($estados),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Compra;
use App\Models\Descuento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompraDescuento>
 */
class CompraDescuentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'compra_id' y 'descuento_id' se asignarán en el seeder
            'monto_aplicado' => fake()->randomFloat(2, 5, 200), // Valor ficticio, se calcularía en realidad
        ];
    }
}

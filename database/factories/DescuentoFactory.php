<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Descuento>
 */
class DescuentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['VERANO2024', 'ESTUDIANTE10', 'VIP25', 'PROMO15', 'CUMPLEAÑOS'];
        $descripciones = [
            'Descuento de temporada de verano.',
            'Oferta especial para estudiantes.',
            'Descuento exclusivo para socios VIP.',
            'Promoción de lanzamiento.',
            'Regalo de cumpleaños.'
        ];

        $inicio = fake()->dateTimeBetween('-1 week', '+1 week');
        $fin = (clone $inicio)->modify('+'.fake()->numberBetween(7, 30).' days');

        return [
            'codigo' => fake()->unique()->regexify('[A-Z0-9]{8}'), // Ej: A1B2C3D4
            'descripcion' => fake()->randomElement($descripciones),
            'porcentaje' => fake()->randomElement([5.00, 10.00, 15.00, 20.00, 25.00]),
            // 'monto_fijo' => null, // Se deja null si se usa porcentaje
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'usos_maximos' => fake()->optional(0.7, null)->numberBetween(50, 500), // 70% tienen límite
            'usos_actuales' => 0,
            'activo' => fake()->boolean(80), // 80% activo
        ];
    }
}

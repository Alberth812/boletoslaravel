<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoDeBoleto>
 */
class TipoDeBoletoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = ['General', 'VIP', 'Platinum', 'Backstage', 'Estudiante', 'Discapacitado'];
        $descripciones = [
            'Acceso estándar al evento.',
            'Acceso con beneficios exclusivos.',
            'Acceso premium con zona VIP.',
            'Acceso detrás del escenario.',
            'Descuento especial para estudiantes.',
            'Acceso adaptado para personas con movilidad reducida.'
        ];
        $zonas = ['General', 'VIP', 'Platea', 'Palco', 'Cesped', 'Tribuna'];

        return [
            'nombre' => fake()->randomElement($nombres),
            'descripcion' => fake()->randomElement($descripciones),
            'precio_base' => fake()->randomFloat(2, 20, 500),
            'zona_asiento' => fake()->randomElement($zonas),
        ];
    }
}

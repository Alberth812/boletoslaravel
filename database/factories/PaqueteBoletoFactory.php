<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaqueteBoleto>
 */
class PaqueteBoletoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = [
            'Pase de Fin de Semana', 'Experiencia VIP', 'Pack Familiar',
            'Entrada + Merchandising', 'Acceso Temprano + Meet & Greet'
        ];
        $descripciones = [
            'Acceso a todos los días del evento.',
            'Entrada VIP + bebidas + zona exclusiva.',
            'Dos entradas generales + merchandising.',
            'Entrada + camiseta oficial + poster.',
            'Entrada con acceso 2 horas antes + foto con el artista.'
        ];

        return [
            'nombre' => fake()->randomElement($nombres),
            'descripcion' => fake()->randomElement($descripciones),
            'precio' => fake()->randomFloat(2, 50, 1000),
            'cantidad_boletos' => fake()->numberBetween(2, 5),
            'activo' => fake()->boolean(90), // 90% activo
        ];
    }
}

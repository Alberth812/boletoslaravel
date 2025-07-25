<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubicacion>
 */
class UbicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ciudades = ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza', 'Málaga', 'Murcia', 'Palma', 'Las Palmas', 'Bilbao'];
        $paises = ['España', 'México', 'Argentina', 'Colombia', 'Chile'];
        $lugares = [
            'Estadio Wanda Metropolitano', 'Palau Sant Jordi', 'Wizink Center', 'Auditorio Nacional',
            'Teatro Real', 'Caja Mágica', 'Velódromo de Anoeta', 'Palacio de Deportes',
            'Fibes Palacio de Congresos', 'Parque de María Luisa'
        ];

        return [
            'nombre' => fake()->randomElement($lugares),
            'direccion' => fake()->streetAddress(),
            'ciudad' => fake()->randomElement($ciudades),
            'pais' => fake()->randomElement($paises),
            'capacidad' => fake()->numberBetween(5000, 80000),
        ];
    }
}

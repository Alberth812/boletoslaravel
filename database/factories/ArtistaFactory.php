<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artista>
 */
class ArtistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = [
            'Los Planetas', 'Rosalía', 'Izal', 'Love of Lesbian', 'Extremoduro',
            'Shakira', 'Bad Bunny', 'Taylor Swift', 'Ed Sheeran', 'BTS',
            'Queen', 'The Beatles', 'Metallica', 'Coldplay', 'Radiohead'
        ];
        $generos = [
            'Rock', 'Pop', 'Reggaeton', 'Hip Hop', 'Jazz', 'Clásica',
            'Electrónica', 'Folk', 'Indie', 'Metal', 'Blues', 'Salsa'
        ];

        return [
            'nombre' => fake()->randomElement($nombres),
            'descripcion' => fake()->paragraph(),
            'imagen' => 'artistas/' . fake()->image(null, 300, 300, 'people', false),
            'genero_musical' => fake()->randomElement($generos),
            'pais_origen' => fake()->country(),
        ];
    }
}

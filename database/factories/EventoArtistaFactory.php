<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evento;
use App\Models\Artista;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventoArtista>
 */
class EventoArtistaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = ['Headliner', 'Soporte', 'Especial', 'DJ'];

        return [
            // 'evento_id' y 'artista_id' se asignarán en el seeder para evitar duplicados
            'rol' => fake()->randomElement($roles),
        ];
    }
}

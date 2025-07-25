<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    public function definition(): array
    {
        $nombres = [
            'Festival de Verano', 'Concierto de Rock', 'Ópera en el Parque',
            'Feria del Libro', 'Exposición de Arte Moderno', 'Conferencia Tech',
            'Maratón Ciudadana', 'Festival de Jazz', 'Carnaval Nocturno',
            'Torneo de Videojuegos'
        ];
        $estados = ['Activo', 'Cancelado', 'Finalizado', 'Próximamente'];

        $inicio = fake()->dateTimeBetween('+1 week', '+2 months');
        $fin = (clone $inicio)->modify('+'.fake()->numberBetween(2, 8).' hours');

        return [
            'nombre' => fake()->randomElement($nombres),
            'descripcion' => fake()->paragraph(),
            'inicio' => $inicio,
            'fin' => $fin,
            // 'id_ubicacion' => null, // O simplemente no lo incluimos
            'lugar' => fake()->company(),
            'ciudad' => fake()->city(),
            'pais' => fake()->country(),
            'imagen' => 'eventos/' . fake()->image(null, 640, 480, 'events', false),
            'estado' => fake()->randomElement($estados),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_usuario' => fake()->unique()->userName(),
            'correo' => fake()->unique()->safeEmail(),
            'contraseña_hash' => bcrypt('password'), // Contraseña por defecto
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'telefono' => fake()->phoneNumber(),
            'fecha_nacimiento' => fake()->date('Y-m-d', '-18 years'), // Mayor de 18
            'es_admin' => fake()->boolean(10), // 10% de probabilidad de ser admin
            'esta_activo' => true,
            // 'remember_token' => Str::random(10), // Si tu modelo lo usa
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}

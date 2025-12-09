<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->unique()->sentence(3, true),
            'descripcion'=>fake()->text(),
            'disponible'=>fake()->randomElement(['Si', 'No']),
            'imagen'=>'imagenes/articles/default.jpg',
        ];
    }
}

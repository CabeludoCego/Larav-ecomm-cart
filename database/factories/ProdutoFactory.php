<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name'                  => $this->faker->word(),
        'description'           => $this->faker->paragraph(nbSentences:1),
        'price'                 => $this->faker->randomFloat(2, 500, 1000),
        'stock'                 => $this->faker->randomDigitNot(0),
        ];
    }
}

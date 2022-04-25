<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class UserDocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'user_id' => "int",
        'type' => "mixed",
        'image' => "string",
        'status' => "int"
    ])]
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1,50),
            'type' => $this->faker->randomElement(['rg', 'cpf', 'cnpj', 'pis/pasep', 'titulo_eleitor']),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'status' => $this->faker->numberBetween(1,3)
        ];
    }
}

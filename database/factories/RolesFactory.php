<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class RolesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        "title" => "string",
        "description" => "string"
    ])]
    public function definition(): array
    {
        return [
            "title" => $this->faker->unique()->jobTitle,
            "description" => $this->faker->text(100)
        ];
    }
}

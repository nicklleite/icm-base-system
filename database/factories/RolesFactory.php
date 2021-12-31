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
        "description" => "string",
        "title" => "string"
    ])]
    public function definition(): array
    {
        return [
            "description" => $this->faker->text(100),
            "title" => $this->faker->unique()->jobTitle
        ];
    }
}

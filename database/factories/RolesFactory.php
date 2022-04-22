<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class RolesFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var Role
     */
    protected $model = Role::class;

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

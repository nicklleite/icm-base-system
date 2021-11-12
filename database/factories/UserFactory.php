<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var User
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        "hash" => "string",
        "email" => "string",
        "username" => "string",
        "full_name" => "string"
    ])]
    public function definition(): array
    {
        return [
            "hash" => (string)Str::uuid(),
            "email" => $this->faker->unique()->safeEmail,
            "username" => $this->faker->userName,
            "full_name" => $this->faker->name
        ];
    }
}

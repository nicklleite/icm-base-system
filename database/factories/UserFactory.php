<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Hash;
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
        "person_id" => "integer",
        "role_id" => "integer",
        "hash" => "string",
        "email" => "string",
        "username" => "string",
        "password" => "string"
    ])]
    public function definition(): array
    {
        return [
            "person_id" => $this->faker->numberBetween(1,50),
            "role_id" => $this->faker->numberBetween(1,2),
            "hash" => (string) Str::uuid(),
            "email" => $this->faker->unique()->safeEmail,
            "username" => $this->faker->userName,
            "password" => Hash::make($this->faker->password)
        ];
    }
}

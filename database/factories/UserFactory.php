<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "hash" => (string)Str::uuid(),
            "email" => $this->faker->unique()->safeEmail,
            "username" => $this->faker->userName,
            "full_name" => $this->faker->name
        ];
    }
}

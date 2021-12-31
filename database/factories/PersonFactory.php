<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class PersonFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var Person
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'full_name' => "string",
        'social_name' => "string",
        'birthday' => "string",
        'is_pwd' => "bool",
        'birth_country' => "string",
        'birth_city' => "string"
    ])]
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'social_name' => $this->faker->name(),
            'birthday' => $this->faker->date(),
            'is_pwd' => $this->faker->boolean(),
            'birth_country' => $this->faker->country(),
            'birth_city' => $this->faker->city()
        ];
    }
}

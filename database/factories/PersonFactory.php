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
        'company_id' => "int",
        'hash' => "string",
        'full_name' => "string",
        'social_name' => "string",
        'birthday' => "string",
        'birth_city' => "string",
        'birth_state' => "mixed",
        'birth_country' => "string",
        'is_pwd' => "bool"
    ])]
    public function definition(): array
    {
        return [
            'company_id' => $this->faker->numberBetween(1,50),
            'hash' => $this->faker->uuid(),
            'full_name' => $this->faker->name(),
            'social_name' => $this->faker->name(),
            'birthday' => $this->faker->date(),
            'birth_city' => $this->faker->city(),
            'birth_state' => $this->faker->state(),
            'birth_country' => $this->faker->country(),
            'is_pwd' => $this->faker->boolean(),
        ];
    }
}

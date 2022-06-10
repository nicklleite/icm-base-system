<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var Company
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "hash" => (string)Str::uuid(),
            "company_name" => $this->faker->company,
            "trading_name" => $this->faker->company,
            "registered_number" => $this->faker->unique()->cnpj(false),
        ];
    }
}

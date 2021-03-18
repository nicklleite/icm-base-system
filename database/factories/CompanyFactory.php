<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return [
            'access_token' => $this->faker->md5(),
            "company_name" => $this->faker->company(),
            "trading_name" => $this->faker->company(),
            "employer_identification_number" => $this->faker->bothify('########0001##'),
        ];
    }
}

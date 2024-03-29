<?php

namespace Database\Seeders;

use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('people')->insert([
            'id' => 1,
            'company_id' => 1,
            'hash' => (string) Str::uuid(),
            "full_name" => "Nicholas Lopes Leite",
            "social_name" => "Nicholas Lopes Leite",
            "birthday" => Carbon::create("1991", "10", "31"),
            "birth_city" => "Ribeirão Preto",
            "birth_state" => "São Paulo",
            "birth_country" => "Brasil",
            'is_pwd' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Person::factory()->count(49)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            "id" => 1,
            "hash" => (string) Str::uuid(),
            "company_name" => "Razão Social da Empresa",
            "trading_name" => "Nome Fantasia da Empresa",
            "registered_number" => "11111111000111",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        Company::factory()->count(50)->create();
    }
}

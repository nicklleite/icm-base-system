<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            "id" => 1,
            "hash" => (string) Str::uuid(),
            "company_name" => "Razão Social da Empresa",
            "trading_name" => "Nome Fantasia da Empresa",
            "registered_number" => "11.111.111/0001-11"
        ]);
    }
}

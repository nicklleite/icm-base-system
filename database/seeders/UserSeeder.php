<?php

namespace Database\Seeders;

use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            "hash" => Str::uuid(),
            "email" => "nicklleite@gmail.com",
            "username" => "nicklleite",
            "full_name" => "Nicholas Leite"
        ]);
    }
}

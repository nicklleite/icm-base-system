<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "id" => 1,
            "person_id" => 1,
            "role_id" => 1,
            "hash" => (string) Str::uuid(),
            "email" => "root@localhost",
            "username" => "root",
            "password" => Hash::make('102040'),
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
            "deleted_at" => null
        ]);
    }
}

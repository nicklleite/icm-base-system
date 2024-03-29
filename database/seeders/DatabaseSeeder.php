<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            PersonSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            UserDocumentSeeder::class
        ]);
    }
}

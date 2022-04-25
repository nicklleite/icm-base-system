<?php

namespace Database\Seeders;

use App\Models\UserDocument;
use Illuminate\Database\Seeder;

class UserDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        UserDocument::factory()->count(50)->create();
    }
}

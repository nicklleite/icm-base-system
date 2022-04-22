<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                "id" => 1,
                "title" => 'Master',
                "description" => "Usuário que possui controle e acesso total ao sistema",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
                "deleted_at" => null
            ], [
                "id" => 2,
                "title" => 'Administrador',
                "description" => "Usuário que possui controle total dos dados do sistema",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
                "deleted_at" => null
            ]
        ]);
    }
}

<?php

use Database\Seeders\CompanySeeder;
use Database\Seeders\PersonSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->seed(CompanySeeder::class);
    $this->seed(PersonSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->seed(UserSeeder::class);

    performLogin();
});

it('expects to create a new role on the system', function() {
    $request = $this->post(route('api.companies.store'), [
        "company_name" => "Razão Social de Testes",
        "trading_name" => "Nome Fantasia de Testes",
        "registered_number" => "22.222.222/0002-22"
    ], ['Accept' => 'application/json']);

    $request->assertStatus(HttpStatusCode::HTTP_CREATED);
});

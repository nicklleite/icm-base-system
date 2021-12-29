<?php

use Database\Seeders\CompanySeeder;
use Database\Seeders\PersonSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(CompanySeeder::class);
    $this->seed(PersonSeeder::class);
    $this->seed(RoleSeeder::class);
    $this->seed(UserSeeder::class);

    performLogin();
});

it('searches for the companies registered on the system', function() {
    $request = $this->get(route('api.companies.index'), ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK);
});

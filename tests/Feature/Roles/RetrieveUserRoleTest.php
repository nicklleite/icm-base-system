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

it('searches for the roles registered on the system (with pagination)', function () {
    $config = base64_encode(json_encode(["isPaginated" => true, "perPage" => 15]));

    $request = $this->get(route('api.roles.index'), ["Accept" => "application/json", "config" => $config]);
    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'current_page', 'data', 'first_page_url',
        'from', 'last_page', 'last_page_url',
        'links', 'next_page_url', 'path',
        'per_page', 'prev_page_url', 'to', 'total'
    ]);
});

it('searches for the roles registered on the system (without pagination)', function () {
    $config = base64_encode(json_encode(["isPaginated" => false]));
    $request = $this->get(route('api.roles.index'), ["Accept" => "application/json", "config" => $config]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        ['title', 'description']
    ]);
});

<?php

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->seed(UserSeeder::class);
});

it('authenticate a user successfully', function() {
    $login = $this->post(route('api.login.authenticate'), [
        "email" => "admin@localhost",
        "password" => "102040"
    ], ['Accept' => "application/json"]);

    $login->assertStatus(HttpStatusCode::HTTP_OK);
});

it('tries to list all users without authenticate', function() {
    $request = $this->get(route('api.users.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED);
});

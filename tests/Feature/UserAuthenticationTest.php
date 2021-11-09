<?php

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(UserSeeder::class);
});

it('authenticate a user successfully', function () {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);
});

it('tries to authenticate with invalid (or not found) information', function () {
    $login = performLogin("", "");
    $login->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure(["errors" => ["email", "password"]]);

    $login = performLogin("admin@localhost", "asd");
    $login->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure(["errors" => ["password"]]);

    $login = performLogin("admin@localhost", "123456789");
    $login->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED)->assertJsonStructure(["message"]);
});

it('tries to list all users without authenticate', function () {
    $request = $this->get(route('api.users.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED);
});

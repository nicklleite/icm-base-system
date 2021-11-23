<?php

use Database\Seeders\PersonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PersonSeeder::class);
    $this->seed(UserSeeder::class);
});

it('authenticate a user successfully', function () {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);
});

it('tests the form validation of login: blank fields', function() {
    $login = performLogin("", "");
    $login->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure(["errors" => ["email", "password"]]);
});

it('tests the form validation of login: invalid password', function() {
    $login = performLogin("admin@localhost", "asd");
    $login->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonStructure(["errors" => ["password"]]);
});

it('tests the form validation of login: wrong credentials', function () {
    $login = performLogin("admin@localhost", "123456789");
    $login->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED)->assertJsonStructure(["message"]);
});

it('tries to perform an action that requires an authenticated user without authenticate into the system', function () {
    $request = $this->get(route('api.users.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED);
});

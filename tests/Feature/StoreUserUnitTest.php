<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->seed(UserSeeder::class);
});

it("expects a successful registration of a new user", function() {
    $login = $this->post(route('api.login.authenticate'), [
        "email" => "admin@localhost",
        "password" => "102040"
    ], ['Accept' => "application/json"]);
    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $request = $this->post('/api/v1/users', [
        "email" => "nicholas@email.com",
        "username" => "nicklleite",
        "password" => Hash::make('102040'),
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_CREATED)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it("expects duplicity errors on \"email\" and \"username\" columns", function() {
    $login = $this->post(route('api.login.authenticate'), [
        "email" => "admin@localhost",
        "password" => "102040"
    ], ['Accept' => "application/json"]);

    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $user = User::first();
    $request = $this->post('/api/v1/users', [
        "email" => $user->email,
        "username" => $user->username,
        "password" => Hash::make('102040'),
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonValidationErrors(['email', 'username']);
});

<?php

use App\Models\User;
use Database\Seeders\PersonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PersonSeeder::class);
    $this->seed(UserSeeder::class);
});

it("expects a successful registration of a new user", function () {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $request = $this->post(route('api.users.store'), [
        "person_id" => 1,
        "email" => "nicholas@email.com",
        "username" => "nicklleite",
        "password" => Hash::make('102040'),
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_CREATED)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it("expects duplicity errors on \"email\" and \"username\" columns", function () {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $user = User::first();
    $request = $this->post(route('api.users.store'), [
        "person_id" => 1,
        "email" => $user->email,
        "username" => $user->username,
        "password" => Hash::make('102040'),
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonValidationErrors(['email', 'username']);
});
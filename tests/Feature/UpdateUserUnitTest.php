<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->seed(UserSeeder::class);
});

it('expects the user to be updated', function() {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $user = User::first();
    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "full_name" => "Nicholas Lopes Leite"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it('expects an error on trying to update the user with duplicated information', function () {
    $login = performLogin();
    $login->assertStatus(HttpStatusCode::HTTP_OK);

    $user = User::first();
    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "email" => $user->email,
        "username" => $user->username,
        "full_name" => "Nicholas Lopes Leite"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonValidationErrors(['email', 'username']);
});

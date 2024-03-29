<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();

    performLogin();
});

it('expects the user to be updated', function () {
    $user = User::first();
    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "email" => "nicklleite@gmail.com"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure(["data" => ["hash", "email", "username"]]);
});

it('expects an error on trying to update the user with duplicated information', function () {
    $user = User::first();
    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "email" => $user->email,
        "username" => $user->username,
        "full_name" => "Nicholas Lopes Leite"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)->assertJsonValidationErrors(['email', 'username']);
});

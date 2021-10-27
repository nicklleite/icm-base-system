<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it("expects a successful load of the edit form and the user to be returned", function() {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $request = $this->get(route('api.users.edit', ["user" => $user->id]), ["Accept" => "application/json"]);
    $request->assertStatus(200)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it('expects the user to be updated', function() {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "full_name" => "Nicholas Lopes Leite"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(200)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it('expects an error on trying to update the user with duplicated information', function () {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $request = $this->patch(route("api.users.update", ["user" => $user->id]), [
        "hash" => $user->hash,
        "email" => $user->email,
        "username" => $user->username,
        "full_name" => "Nicholas Lopes Leite"
    ], ["Accept" => "application/json"]);

    $request->assertStatus(422)->assertJsonValidationErrors(['hash', 'email', 'username']);
});

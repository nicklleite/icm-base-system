<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

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

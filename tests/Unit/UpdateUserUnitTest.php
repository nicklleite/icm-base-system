<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('expects the user to be updated', function() {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $response = $this->patch(route("api.users.update", ["user" => $user]), [
        "full_name" => "Nicholas Lopes Leite",
    ], ["Accept" => "application/json"]);

    $response->assertStatus(204);
});

it('expects an error on trying to update the user with duplicated information', function () {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $response = $this->patch(route("api.users.update", ["user" => $user]), [
        "hash" => $user->hash,
        "email" => $user->email,
        "username" => $user->username,
        "full_name" => "Nicholas Lopes Leite",
    ], ["Accept" => "application/json"]);

    $response->assertStatus(422)->assertJsonValidationErrors(['hash', 'email', 'username']);
});

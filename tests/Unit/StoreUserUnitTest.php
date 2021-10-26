<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it("expects to successfully visit the create form page", function() {
    $request = $this->get('api/v1/users/create');

    $request->assertStatus(200);
});

it("expects a successful registration of a new user", function() {
    $request = $this->post('/api/v1/users', [
        "hash" => (string) Str::uuid(),
        "email" => "nicholas@email.com",
        "username" => "nicklleite",
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(201)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it("expects duplicity errors on \"hash\" and \"email\" columns", function() {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $request = $this->post('/api/v1/users', [
        "hash" => $user->hash,
        "email" => "admin@localhost",
        "username" => "nicklleite",
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(422)->assertJsonValidationErrors(['hash', 'email']);
});

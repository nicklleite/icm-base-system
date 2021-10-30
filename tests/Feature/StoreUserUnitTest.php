<?php

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it("expects to successfully visit the create form page", function() {
    $request = $this->get('api/v1/users/create');

    $request->assertStatus(200);
});

it("expects a successful registration of a new user", function() {
    $request = $this->post('/api/v1/users', [
        "email" => "nicholas@email.com",
        "username" => "nicklleite",
        "password" => Hash::make('102040'),
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(201)->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
});

it("expects duplicity errors on \"email\" and \"username\" columns", function() {
    $this->seed(UserSeeder::class);
    $user = User::first();

    $request = $this->post('/api/v1/users', [
        "email" => "admin@localhost",
        "username" => "admin",
        "password" => Hash::make('102040'),
        "full_name" => "Nicholas Leite",
    ], ["Accept" => "application/json"]);

    $request->assertStatus(422)->assertJsonValidationErrors(['email', 'username']);
});

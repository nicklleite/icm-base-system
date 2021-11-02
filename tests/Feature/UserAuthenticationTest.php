<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

it('authenticate a user successfully', function() {
    $this->seed(UserSeeder::class);

    $request = $this->post(route('api.login.authenticate'), [
        "email" => "admin@localhost",
        "password" => "102040"
    ], ['Accept' => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK);
});

it('tries to list all users without authenticate', function() {
    $request = $this->get(route('api.users.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_UNAUTHORIZED);
});

//it('tries to log into the system and list all the users', function() {
//    $this->seed(UserSeeder::class);
//
//    $request = $this->post(route('api.login.authenticate'), [
//        "email" => "admin@localhost",
//        "password" => "102040"
//    ], ['Accept' => "application/json"]);
//});

<?php

use Carbon\Carbon;
use Database\Seeders\PersonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PersonSeeder::class);
    $this->seed(UserSeeder::class);

    performLogin();
});

it('expects to store a new person on the database', function() {
    $request = $this->post(route('api.persons.store'), [
        "full_name" => "Nicholas Lopes Leite",
        "social_name" => "Nicholas Lopes Leite",
        "birthday" => Carbon::create("1991", "10", "31"),
        "birth_country" => "Brazil",
        "birth_city" => "Ribeirao Preto"
    ], ['Accept' => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_CREATED);
});

it('expects to list all persons on the system', function() {
    $request = $this->get(route('api.persons.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'current_page', 'data', 'first_page_url',
        'from', 'last_page', 'last_page_url',
        'links', 'next_page_url', 'path',
        'per_page', 'prev_page_url', 'to', 'total'
    ]);
});

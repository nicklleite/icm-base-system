<?php

use Database\Seeders\PersonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(PersonSeeder::class);
    $this->seed(UserSeeder::class);
});

it('expects to list all persons on the system', function() {
    performLogin();

    $request = $this->get(route('api.persons.index'), ['Accept' => "application/json"]);
    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'current_page', 'data', 'first_page_url',
        'from', 'last_page', 'last_page_url',
        'links', 'next_page_url', 'path',
        'per_page', 'prev_page_url', 'to', 'total'
    ]);
});

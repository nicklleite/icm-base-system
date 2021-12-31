<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();

    performLogin();
});

it('expects to store a new person on the database', function() {
    $request = $this->post(route('api.people.store'), [
        "company_id" => 1,
        "full_name" => "Nicholas Lopes Leite",
        "social_name" => "Nicholas Lopes Leite",
        "birthday" => Carbon::create("1991", "10", "31"),
        "birth_city" => "Ribeirão Preto",
        "birth_state" => "São Paulo",
        "birth_country" => "Brasil",
        'is_pwd' => false,
    ], ['Accept' => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_CREATED)->assertJsonStructure([
        'data' => ['full_name', 'social_name', 'birthday', 'is_pwd', 'birth_country', 'birth_city']
    ]);
});

<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();

    performLogin();
});

it('searches for the roles registered on the system', function() {
    $request = $this->get(route('api.users.index'), ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'current_page', 'data', 'first_page_url',
        'from', 'last_page', 'last_page_url',
        'links', 'next_page_url', 'path',
        'per_page', 'prev_page_url', 'to', 'total'
    ]);
});


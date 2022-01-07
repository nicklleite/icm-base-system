<?php

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();

    performLogin();
});

it('searches for the companies registered on the system', function() {
    $request = $this->get(route('api.companies.index'), ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'current_page', 'data', 'first_page_url',
        'from', 'last_page', 'last_page_url',
        'links', 'next_page_url', 'path',
        'per_page', 'prev_page_url', 'to', 'total'
    ]);
});

it('retrieves one company registered on the system', function() {
    $company = Company::first();
    $request = $this->get(route('api.companies.show', ['company' => $company]), ["Accept" => "application/json"]);

    $request->assertStatus(HttpStatusCode::HTTP_OK)->assertJsonStructure([
        'data' => ['company_name', 'trading_name', 'registered_number']
    ]);
});

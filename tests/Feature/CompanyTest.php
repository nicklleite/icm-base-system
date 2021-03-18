<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Company;

class CompanyTest extends TestCase {

    // use RefreshDatabase;

    public function testIfAllCompaniesAreListed() {

        // Create 25 Companies in the database
        Company::factory()->count(25)->create();

        // Get all Comapnies (Paginated)
        $response = $this->getJson('/companies')->assertStatus(200);
    }
}

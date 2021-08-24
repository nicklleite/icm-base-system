<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

use Tests\TestCase;

use App\Models\Company;

class CompanyTest extends TestCase {

    /** @test */
    public function testIfCompanyEndpointIsAvailable() {
        $response = $this->get('/api/v1/companies');
        $response->assertStatus(200);
    }

    /** @test */
    public function testIfCompaniesListIsEmpty() {

        $response = $this->getJson('/api/v1/companies');
        $response->assertStatus(200);

        $json = json_decode($response->content(), true);
        $response->assertJsonStructure([
            'data' => [],
            'links' => [
                "first",
                "last",
                "prev",
                "next",
            ],
            'meta' => [
                "current_page",
                "from",
                "path",
                "per_page",
                "to",
            ],
        ]);
    }

    /** @test */
    public function testIfAllCompaniesAreListed() {

        // Create 25 Companies in the database
        Company::factory()->count(25)->create();

        // Get all Comapnies (Paginated)
        $response = $this->getJson('/api/v1/companies');
        $response->assertStatus(200);
        
        $json = json_decode($response->content(), true);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    "access_token",
                    "company_name",
                    "trading_name",
                    "employer_identification_number",
                    "created_at",
                ]
            ],
            'links' => [
                "first",
                "last",
                "prev",
                "next",
            ],
            'meta' => [
                "current_page",
                "from",
                "path",
                "per_page",
                "to",
            ],
        ]);
    }
}

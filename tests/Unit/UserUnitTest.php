<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class UserUnitTest extends TestCase
{
    public function testCreateNewApiUser()
    {
        // Creates an User
        $this->seed();

        $this->assertDatabaseHas("users", [
            "email" => "nicklleite@gmail.com"
        ]);
    }

    // public function testRetrieveUserApiById()
    // {

    //     $this->assertTrue(true);
    // }

    // public function testUpdateUserApi()
    // {
        
    //     $this->assertTrue(true);
    // }
}

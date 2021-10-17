<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Expects to create ten fake users, using the UserFactory class
     *
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testUserFactory()
    {
        $users = User::factory()->count(10)->make();
        $this->assertGreaterThanOrEqual(10, $users->count(), "");
    }

    /**
     * Expects a successful registration of a new user
     * 
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testNewUserRegistration()
    {
        $request = $this->post('/api/users', [
            "hash" => (string) Str::uuid(),
            "email" => "nicholas@email.com",
            "username" => "nicklleite",
            "full_name" => "Nicholas Leite",
        ], ["Accept" => "application/json"]);

        $request->assertStatus(201);
    }

    /**
     * Expects duplicity errors on "hash" and "email" columns
     * 
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testNewUserRegistrationWithDuplicatedEmail()
    {
        $this->seed(UserSeeder::class);

        $user = User::first();

        $request = $this->post('/api/users', [
            "hash" => $user->hash,
            "email" => "admin@localhost",
            "username" => "nicklleite",
            "full_name" => "Nicholas Leite",
        ], ["Accept" => "application/json"]);
        
        $request->assertStatus(422);
        $request->assertJsonValidationErrors(['hash', 'email']);
    }

}

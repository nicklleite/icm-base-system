<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreUserUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Expects a successful registration of a new user
     *
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testNewUserRegistration()
    {
        $request = $this->post('/api/v1/users', [
            "hash" => (string) Str::uuid(),
            "email" => "nicholas@email.com",
            "username" => "nicklleite",
            "full_name" => "Nicholas Leite",
        ], ["Accept" => "application/json"]);

        $request->assertStatus(201);
        $request->assertJsonStructure(["data" => ["hash", "email", "username", "full_name"]]);
    }

    /**
     * Expects duplicity errors on "hash" and "email" columns
     *
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testNewUserRegistrationWithDuplicatedInfo()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();

        $request = $this->post('/api/v1/users', [
            "hash" => $user->hash,
            "email" => "admin@localhost",
            "username" => "nicklleite",
            "full_name" => "Nicholas Leite",
        ], ["Accept" => "application/json"]);

        $request->assertStatus(422);
        $request->assertJsonValidationErrors(['hash', 'email']);
    }

}

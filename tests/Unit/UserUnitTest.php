<?php

namespace Tests\Unit;

use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class UserUnitTest extends TestCase
{
    /**
     * Expects that the default user was created.
     * 
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testIfUserTableWereSeeded()
    {
        $this->assertDatabaseHas("users", [
            "email" => "admin@localhost"
        ]);
    }

    /**
     * Expects that the default user was soft deleted.
     * 
     * @package Tests
     * @subpackage Unit
     * @author Nicholas Leite <nicklleite@gmail.com>
     */
    public function testSoftDeleteAUser() {
        $user = User::where("email", "admin@localhost")->firstOrFail();
        $user->deleted_at = date("Y-m-d H:i:s");
        $user->update();

        $this->assertSoftDeleted("users", [
            "email" => "admin@localhost"
        ]);
    }
}

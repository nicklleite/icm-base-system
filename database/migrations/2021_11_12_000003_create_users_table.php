<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('person_id')->constrained('people');
            $table->foreignId('role_id')->constrained('roles');

            $table->string('hash')->unique()->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->string('password')->nullable(false);

            $table->timestamps();
            $table->softDeletes($column = 'deleted_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

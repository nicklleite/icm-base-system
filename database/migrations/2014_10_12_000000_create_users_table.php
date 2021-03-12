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
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('person_id');
            $table->foreignId('company_id');
            $table->string('username')->unique();
            $table->string('email')->unique()->comment("On a GUI, this collumn have to be 'readonly'. This is the main email address and it will recieve the notifications of what happens on the system. Other emails should be saved on the 'contacts' table.");
            $table->string('password');
            $table->string('personal_identification_key', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 - Inactive; 1 - Active; 2 - Blocked');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}

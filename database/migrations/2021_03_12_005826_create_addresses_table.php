<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('person_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('description');
            $table->string('zipcode');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('district');
            $table->string('city');
            $table->string('state');
            $table->string('country');
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
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

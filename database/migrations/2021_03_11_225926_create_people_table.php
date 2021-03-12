<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('person_type')->default(1)->comment('1 - Natural person (Brazil: Pessoa Física); 2 - Legal person (Brazil: Pessoa Jurídica)');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('personal_id')->unique()->comment('In Brazil, a.k.a RG.')->nullable();
            $table->string('social_secutiry_number')->unique()->comment('In Brazil, a.k.a CPF.')->nullable();
            $table->string('employer_identification_number')->unique()->comment('In Brazil, a.k.a CNPJ.')->nullable();
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
        Schema::dropIfExists('people');
    }
}

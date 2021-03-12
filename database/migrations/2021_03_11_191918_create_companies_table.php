<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->comment('In Brazil, a.k.a Razão Social.');
            $table->string('trading_name')->comment('In Brazil, a.k.a Nome Fantasia.');
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
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}

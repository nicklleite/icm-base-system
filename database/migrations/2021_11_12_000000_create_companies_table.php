<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash')->unique()->nullable(false);
            $table->string('company_name')->nullable(false);
            $table->string('trading_name')->nullable(false);
            $table->string('registered_number')->nullable(false);

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
        Schema::dropIfExists('companies');
    }
}

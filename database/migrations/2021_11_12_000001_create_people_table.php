<?php

use App\Models\Company;
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
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Company::class);

            $table->string('hash')->unique()->nullable(false);

            $table->string('full_name')->nullable(false);
            $table->string('social_name')->nullable(false);
            $table->date('birthday')->nullable(false);
            $table->string('birth_city')->nullable(false);
            $table->string('birth_state')->nullable(false);
            $table->string('birth_country')->nullable(false);

            $table->boolean('is_pwd')->default(false);

            // Personal documents will be another table
            // Addresses will be another table
            // Contacts will be another table

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
        Schema::dropIfExists('people');
    }
}

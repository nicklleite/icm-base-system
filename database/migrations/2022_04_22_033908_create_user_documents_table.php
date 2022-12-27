<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class);

            $table->string('type')->nullable(false)->comment("(Ex.: RG, CPF, PIS/PASEP)");

            /**
             * TODO: Define how the images should be stored:
             * - Save the images into the filesystem
             * - Send the images to the cloud and store the link
             */
            $table->string("image")->nullable(false)->comment("Imagem do documento.");

            $table->tinyInteger("status")->default(1)->comment("1 - 'Sob Análise'; 2 - 'Aprovado'; 3 - 'Rejeitado'");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_documents');
    }
}

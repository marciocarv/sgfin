<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('associacao');
            $table->string('codigo_inep');
            $table->string('email');
            $table->string('telefone');
            $table->dateTime('date_criacao');
            $table->string('presidente')->default('');
            $table->string('secretario')->default('');
            $table->string('caf')->default('');
            $table->string('modulo')->default('');
            $table->string('cnpj')->default('');
            $table->string('adress')->default('');
            $table->string('cep')->default('');
            $table->string('lei_criacao')->default('');
            $table->string('autorizacao_funcionamento')->default('');
            $table->string('image_lei')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}

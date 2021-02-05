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
            $table->string('codigo_inep');
            $table->string('email');
            $table->string('telefone');
            $table->dateTime('date_criacao')->nullable();
            $table->string('diretor')->nullable();
            $table->string('secretario')->nullable();
            $table->string('caf')->nullable();
            $table->string('modulo')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('adress')->nullable();
            $table->string('cep')->nullable();
            $table->string('lei_criacao')->nullable();
            $table->string('autorizacao_funcionamento')->nullable();
            $table->string('image_lei')->nullable();
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

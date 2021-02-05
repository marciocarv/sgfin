<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained();
            $table->string('name')->nullable();
            $table->string('presidente')->nullable();
            $table->string('vice_presidente')->nullable();
            $table->string('secretario')->nullable();
            $table->string('segundo_secretario')->nullable();
            $table->string('tesoureiro')->nullable();
            $table->string('segundo_tesoureiro')->nullable();
            $table->string('membro_1')->nullable();
            $table->string('membro_2')->nullable();
            $table->string('membro_3')->nullable();
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
        Schema::dropIfExists('aces');
    }
}

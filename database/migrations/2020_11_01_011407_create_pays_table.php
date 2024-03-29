<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expenditure_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_pay')->nullable();
            $table->string('number_invoice')->nullable();
            $table->dateTime('emission_invoice')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('interest', 10, 2)->nullable();
            $table->string('document_type')->nullable();
            $table->string('number_cheque')->nullable();
            $table->decimal('value_paid', 10, 2)->nullable();
            $table->decimal('tax', 10, 2);
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
        Schema::dropIfExists('pays');
    }
}

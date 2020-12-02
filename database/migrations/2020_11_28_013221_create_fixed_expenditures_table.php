<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedExpendituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_expenditures', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->integer('provider_id');
            $table->string('description');
            $table->datetime('emission_date');
            $table->decimal('value', 10, 2);
            $table->string('nature');
            $table->datetime('expiration_date');
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
        Schema::dropIfExists('fixed_expenditures');
    }
}

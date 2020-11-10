<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdinancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordinances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained();
            $table->string('description');
            $table->dateTime('date_ordinance');
            $table->string('number_diario');
            $table->string('nature');
            $table->string('font');
            $table->string('image');
            $table->decimal('value_custeio', 10, 2);
            $table->decimal('value_capital', 10, 2);
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('ordinances');
    }
}

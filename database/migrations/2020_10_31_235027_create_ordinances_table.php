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
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('number')->nullable();
            $table->string('description')->nullable();
            $table->string('number_process')->nullable();
            $table->dateTime('date_ordinance')->nullable();
            $table->string('number_diario')->nullable();
            $table->string('nature')->nullable();
            $table->string('source')->nullable();
            $table->decimal('value_custeio', 10, 2)->default(0.00);
            $table->decimal('value_capital', 10, 2)->default(0.00);
            $table->decimal('amount', 10, 2)->nullable();
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

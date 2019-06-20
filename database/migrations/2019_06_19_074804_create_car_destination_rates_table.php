<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarDestinationRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_destination_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('car_id')->unsigned();
            $table->string('destination');
            $table->float('rate', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_destination_rates');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPickUpDropOffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_pick_up_drop_off', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('car_id')->unsigned();
            $table->string('pick_up');
            $table->string('drop_off');
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
        Schema::dropIfExists('car_pick_up_drop_off');
    }
}

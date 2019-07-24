<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('tour_id');
            $table->date('date_of_tour');
            $table->time('pick_up_time');
            $table->text('pick_up_address');
            $table->timestamps();

            //foreign keys
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('tour_id')->references('id')->on('tour_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_tours');
    }
}

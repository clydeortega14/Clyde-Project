<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustPenaltiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cust_penalties', function (Blueprint $table) {
            $table->unsignedBigInteger('cust_id');
            $table->unsignedBigInteger('penalty_id');

            //foreign key
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penalty_id')->references('id')->on('penalties')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['cust_id', 'penalty_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cust_penalties');
    }
}

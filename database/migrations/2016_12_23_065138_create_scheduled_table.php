<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduled', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reciver_id')->unsigned();
            $table->foreign('reciver_id')->references('id')->on('pendaftar');
            $table->string('message');
            $table->date('date_recive');
            $table->time('time_recive');
            $table->enum('status',['delive','delay']);
            $table->timestamp('deleted_at');
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
        Schema::dropIfExists('scheduled');
    }
}

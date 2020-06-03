<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 64)->unique()->comment('ラインID')->nullable();
            $table->string('player_id', 64)->unique()->comment('ラインID')->nullable();
            $table->integer('status')->default(10)->comment('10=>仮予約、20=>却下,30=>確定');
            $table->integer('category')->default(10)->comment('10=>ライン、20=>WEB');
            $table->dateTime('reservation_at')->comment('10=>ライン、20=>WEB');
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
        Schema::dropIfExists('reservations');
    }
}

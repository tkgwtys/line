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
            $table->string('reservation_id', 64)->comment('予約ID')->nullable();
            $table->string('user_id', 64)->comment('予約者')->nullable();
            $table->string('player_id', 64)->comment('トレーナ')->nullable();
            $table->integer('status')->default(10)->comment('10=>仮予約、20=>却下,30=>確定');
            $table->integer('category')->default(10)->comment('10=>ライン、20=>WEB');
            $table->integer('course_id')->comment('コースID');
            $table->integer('store_id')->comment('店舗ID');
            $table->dateTime('reserved_at')->comment('10=>ライン、20=>WEB');
            $table->timestamps();
            $table->index(['reservation_id', 'user_id', 'player_id']);
            $table->index('reserved_at');
            $table->softDeletes();
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

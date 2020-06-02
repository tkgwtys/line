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
            //ユーザー情報
            $table->bigIncrements('reservation_id')->comment('予約ID');
            $table->string('line_id', 64)->comment('LINE ID')->nullable(); //LINE IDで紐づけてusersテーブルからユーザー情報取得
            //予約情報
            $table->date('reserved_date')->comment('予約日');
            $table->time('reserved_time')->comment('予約時間');
            $table->string('reserved_trainer')->comment('予約トレーナー');
            //管理者用情報
            $table->timestamp('reserved_at')->comment('予約発生日');
            $table->timestamp('canceled_at')->comment('ユーザーキャンセル日');
            $table->timestamp('changed_at')->comment('予約変更日');
            $table->timestamp('confirmed_at')->comment('予約承認日');
            $table->timestamp('refused_at')->comment('予約却下日');
            $table->string('player_id')->comment('操作実行トレーナーID'); //player_idで紐づけてplayersテーブルからプレイヤー情報取得


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

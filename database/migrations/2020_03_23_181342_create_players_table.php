<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->string('id', 64)->unique()->comment('プレイヤーID')->nullable();
            $table->string('sei')->comment('性')->nullable();
            $table->string('mei')->comment('名')->nullable();
            $table->string('sei_hira')->comment('セイ')->nullable();
            $table->string('mei_hira')->comment('メイ')->nullable();
            $table->text('self_introduction')->comment('説明');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('players');
    }
}

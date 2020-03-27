<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('player_id', 64)->comment('プレイヤーID')->nullable();
            $table->string('file_name')->comment('ファイル名')->nullable();
            $table->timestamps();
            $table->index('player_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_images');
    }
}

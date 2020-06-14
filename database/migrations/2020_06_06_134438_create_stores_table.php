<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('ショップ名')->nullable();
            $table->string('address')->comment('住所')->nullable();
            $table->string('tel')->comment('電話番号')->nullable();
            $table->string('url')->comment('HP')->nullable();
            $table->string('business_hours')->comment('営業事案')->nullable();
            $table->string('color_code')->comment('カラーコード')->nullable();
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
        Schema::dropIfExists('stores');
    }
}

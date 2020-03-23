<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 64)->unique()->comment('ラインID')->nullable();
            $table->string('name')->comment('ラインの表示名')->nullable();
            $table->string('sei')->comment('性')->nullable();
            $table->string('mei')->comment('名')->nullable();
            $table->string('sei_kana')->comment('セイ')->nullable();
            $table->string('mei_kana')->comment('メイ')->nullable();
            $table->integer('tel')->comment('電話番号')->nullable();
            $table->string('email')->unique()->comment('メールアドレス')->nullable();
            $table->timestamp('email_verified_at')->nullable()->nullable();
            $table->string('password')->comment('パスワード')->nullable();
            $table->rememberToken();
            $table->timestamp('blocked_at')->unique()->nullable();
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
        Schema::dropIfExists('users');
    }
}

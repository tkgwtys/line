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
            $table->string('display_name')->comment('ラインの表示名')->nullable();
            $table->string('sei')->comment('性')->nullable();
            $table->string('mei')->comment('名')->nullable();
            $table->string('sei_hira')->comment('せい')->nullable();
            $table->string('mei_hira')->comment('めい')->nullable();
            $table->string('picture_url')->comment('ラインプロフィール画像')->nullable();
            $table->string('self_introduction')->comment('自己紹介')->nullable();
            $table->string('tel')->comment('電話番号')->nullable();
            $table->integer('level')->comment('10 => 一般、20 => トレーナー')->nullable()->default(10);
            $table->string('email')->unique()->comment('メールアドレス')->nullable();
            $table->timestamp('email_verified_at')->nullable()->nullable();
            $table->string('password')->comment('パスワード')->nullable();
            $table->rememberToken();
            $table->timestamp('blocked_at')->comment('ブロックした日付')->unique()->nullable();
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

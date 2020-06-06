<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('コース名')->nullable();
            $table->integer('price')->comment('１回価格')->nullable();
            $table->integer('total_price')->comment('合計価格')->nullable();
            $table->integer('month_count')->comment('月何回通えるか')->nullable();
            $table->integer('course_time')->comment('コース時間')->nullable();
            $table->string('description')->comment('コース説明')->nullable();
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
        Schema::dropIfExists('courses');
    }
}

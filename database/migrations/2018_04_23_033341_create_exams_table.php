<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->date('test_day');
            $table->string('test_hour');
            $table->string('location');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');
            $table->integer('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')
                ->on('classes')->onDelete('cascade');
            $table->enum('type', ['quiz', 'final', 'midterm']);
            $table->string('grade');
            $table->softDeletes();
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
        Schema::dropIfExists('exams');
    }
}

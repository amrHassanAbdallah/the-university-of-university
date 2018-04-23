<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_exam', function (Blueprint $table) {
            $table->integer('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')
                ->on('classes')->onDelete('cascade');

            $table->integer('exam_id')->unsigned()->nullable();
            $table->foreign('exam_id')->references('id')
                ->on('exams')->onDelete('cascade');
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
        Schema::dropIfExists('class_exam');
    }
}

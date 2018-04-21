<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_classes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->integer('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')
                ->on('classes')->onDelete('cascade');
            $table->enum('state', ['paid', 'postponed'])->default('postponed');

            $table->boolean('active');

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
        Schema::dropIfExists('user_classes');
    }
}

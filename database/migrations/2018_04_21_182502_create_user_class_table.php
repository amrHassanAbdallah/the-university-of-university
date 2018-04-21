<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_class', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->integer('class_id')->unsigned()->nullable();
            $table->foreign('class_id')->references('id')
                ->on('classes')->onDelete('cascade');
            $table->enum('state', ['paid', 'postponed'])->default('postponed');

            $table->boolean('active')->default(1);

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
        Schema::dropIfExists('user_class');
    }
}

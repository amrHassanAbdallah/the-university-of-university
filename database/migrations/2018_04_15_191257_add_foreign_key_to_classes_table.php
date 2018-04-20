<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToClassesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('classes', function (Blueprint $table) {
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
			$table->foreign('course_id')
				->references('id')->on('courses')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('classes', function (Blueprint $table) {
			$table->dropForeign(['course_id']);
			$table->dropForeign(['user_id']);
		});
	}
}

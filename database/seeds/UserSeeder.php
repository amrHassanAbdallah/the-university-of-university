<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'name' => "admin",
			'email' => "admin@admin.com",
			'level' => 'admin',
			'password' => bcrypt("admin"),
		]);
		User::create([
			'name' => "teacher",
			'email' => "teacher@teacher.com",
			'level' => 'teacher',
			'password' => bcrypt("teacher"),
		]);
		User::create([
			'name' => "student",
			'email' => "student@student.com",
			'level' => 'student',
			'password' => bcrypt("student"),
		]);
	}
}

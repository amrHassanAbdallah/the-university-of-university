<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(UserSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(ClassSeeder::class);

    }
}

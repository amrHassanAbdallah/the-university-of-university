<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = new Faker();

        $coursesIDs = DB::table('courses')->pluck('id')->toArray();
        $studentsIDs = DB::table('users')->where('level', 'teacher')->pluck('id')->toArray();
        foreach (range(1, 10) as $index) {
            DB::table('classes')->insert([
                'user_id' => $studentsIDs[array_rand($studentsIDs, 1)],
                'course_id' => $coursesIDs[array_rand($coursesIDs, 1)],
                'date' => 'sunday at 9am',
                'location' => 1 . 'th floor',
                'name' => 'awesome class',
            ]);
        }

    }
}

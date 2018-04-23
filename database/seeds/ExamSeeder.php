<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $coursesIDs = DB::table('courses')->pluck('id')->toArray();
        foreach (range(1, 10) as $index) {


            DB::table('exams')->insert([
                'course_id' => $coursesIDs[array_rand($coursesIDs, 1)],
                'test_day' => date('Y-m-d'),
                'test_hour' => '9pm',
                'location' => 1 . 'th floor',
                'grade' => 15,
                'type' => 'quiz'
            ]);
        }
    }
}

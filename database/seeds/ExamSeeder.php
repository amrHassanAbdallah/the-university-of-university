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
        $classesIDs = DB::table('users')->where('level', 'teacher')->pluck('id')->toArray();
        foreach (range(1, 10) as $index) {
            $teacher_id = $classesIDs[array_rand($classesIDs, 1)];
            $course_id = $coursesIDs[array_rand($coursesIDs, 1)];
            $teacher = \App\User::find($teacher_id);
            $course = \App\Course::find($course_id);
            DB::table('exams')->insert([
                'class_id' => $classesIDs[array_rand($classesIDs, 1)],
                'course_id' => $coursesIDs[array_rand($coursesIDs, 1)],
                'test_day' => date('Y-m-d'),
                'test_hour' => '9pm',
                'location' => 1 . 'th floor',
                'grade' => 16,
                'type' => 'quiz'
            ]);
        }
    }
}

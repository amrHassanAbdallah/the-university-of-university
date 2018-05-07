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
        factory('App\User', 10)->create();
        $coursesIDs = DB::table('courses')->pluck('id')->toArray();
        $teachersIds = DB::table('users')->where('level', 'teacher')->pluck('id')->toArray();
        $teacher_id = \App\User::where('email', 'teacher@teacher.com')->first()->id;
        $course_id = $coursesIDs[array_rand($coursesIDs, 1)];
        $teacher = \App\User::find($teacher_id);
        $course = \App\Course::find($course_id);
        $class = \App\StudentClass::create([
            'user_id' => $teacher_id,
            'course_id' => $coursesIDs[array_rand($coursesIDs, 1)],
            'date' => 'sunday at 9am',
            'location' => 1 . 'th floor',
            'name' => $course->name . ' by ' . $teacher->name,
        ]);
        foreach (range(1, 10) as $index) {
            $teacher_id = $teachersIds[array_rand($teachersIds, 1)];
            $course_id = $coursesIDs[array_rand($coursesIDs, 1)];
            $teacher = \App\User::find($teacher_id);
            $course = \App\Course::find($course_id);
            DB::table('classes')->insert([
                'user_id' => $teachersIds[array_rand($teachersIds, 1)],
                'course_id' => $coursesIDs[array_rand($coursesIDs, 1)],
                'date' => 'sunday at 9am',
                'location' => 1 . 'th floor',
                'name' => $course->name . ' by ' . $teacher->name,
            ]);

        }
        $studentsIds = \App\User::where('level', 'student')->get();
        /*            $class = \App\StudentClass::where('user_id',$teacher_id)->first();*/
        foreach ($studentsIds as $studentsId) {
            $class->User()->save($studentsId);
        }


    }
}

<?php

namespace App\Http\Controllers;

use App\Course;
use App\Registration;
use App\StudentClass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'join', 'cancelEnrollment', 'show']);
        $this->middleware('student')->only(['join', 'cancelEnrollment']);

        //permission for show and index

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*dd(            Auth::user()->Classes()->where('active',1)->get()
);*/
        if (Auth::user()->level === "admin" || Auth::user()->level === "student") {
            return view('admin.class.index')->with([
                'classes' => StudentClass::all(),
                'myClasses' => Auth::user()->Classes()->where('active', 1)->get()
            ]);
        } elseif (Auth::user()->level === "teacher") {
            return view('admin.class.index')->with([
                'classes' => StudentClass::getAllTeacherClasses(Auth::user()->id),
                'myClasses' => []

            ]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.class.create')->with([
            'courses' => Course::all(),
            'teachers' => User::where("level", 'teacher')->get()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = StudentClass::store(StudentClass::getDataFromRequest(StudentClass::getRequiredAttribute('post'),
            $request));
        if ($res["state"]) {
            return redirect()->back()->with('errors', $res['data']);
        }
        return redirect()->back()->with('success', 'a new Course have been added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        $userLevel = Auth::user()->level;
        $class = StudentClass::find($id);
        if ($userLevel === "student") {
            $course = Course::find($class->id);
            return view('admin.class.single')->with([
                'class' => StudentClass::find($id),
                'course' => $course,
                'teacher' => User::find($class->user_id),
                'PreCourses' => $course->getPreqCourse()
            ]);
        } else {
            $students = $class->User;
            return view('teacher.students')->with([
                'students' => $students,
                'exams' => $class->Course->Exam

            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('admin.class.edit')->with([
            'class' => StudentClass::find($id),
            'courses' => Course::all(),
            'teachers' => User::where("level", 'teacher')->get()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = StudentClass::updateIt(StudentClass::getDataFromRequest(StudentClass::getRequiredAttribute('put'),
            $request), $id);
        if ($res["state"]) {
            return redirect()->back()->with('errors', $res['data']);
        }
        return redirect()->back()->with('success', 'Class updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentClass::find($id)->delete();
        return redirect()->back()->with('success', 'Class deleted !');
    }

    public function join($id)
    {
        $registration = Registration::orderBy('updated_at', 'desc')->first();
        $now = date('Y-m-d');
        if ($registration) {

            if ($now > $registration->start && $now < $registration->end) {
                $class = StudentClass::find($id);
                $course = Course::find($class->course_id);
                $coursePreIds = $course->getPrequestedCoursesIds();
                $UserTokeIT = Auth::user()->Classes()->where('course_id', $course->id)->where('active', 1)->get();
                $TotallActiveCourses = Auth::user()->Classes()->where('active', 1)->count();

                if (count($UserTokeIT) === count($coursePreIds) && !count($UserTokeIT) && $TotallActiveCourses < 9) {
                    $class->user()->save(Auth::user());

                    return redirect()->back()->with('success', 'your enrollment will be held till you pay the fees .');

                }
                if (count($UserTokeIT) !== count($coursePreIds)) {
                    return redirect()->back()->with('error', 'you have not met the Prerequisite yet!');

                }
                return redirect()->back()->with('error', 'you already joined this class');
        }

            return redirect()->back()->with('error', ' you can not register after the registration deadline !! . ');

        }
        return redirect()->back()->with('error', 'registration have not opened yet please wait ');


    }

    public function cancelEnrollment($id)
    {
        $class = Auth::user()->Classes()->where('id', $id)->first();
        if ($class) {

            Auth::user()->Classes()->detach($class);
        }

        return redirect()->back()->with('success', 'your enrollment canceled successfully');
    }
}

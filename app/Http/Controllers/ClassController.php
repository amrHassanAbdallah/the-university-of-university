<?php

namespace App\Http\Controllers;

use App\Course;
use App\StudentClass;
use App\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.class.index')->with('classes', StudentClass::all());

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
        $class = StudentClass::find($id);
        $course = Course::find($class->id);
        return view('admin.class.single')->with([
            'class' => StudentClass::find($id),
            'course' => $course,
            'teacher' => User::find($class->user_id),
            'PreCourses' => $course->getPreqCourse()
        ]);
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


    }
}

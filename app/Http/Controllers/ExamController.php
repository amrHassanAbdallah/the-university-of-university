<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\StudentClass;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.exam.index')->with('exams', Exam::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.exam.create')->with(['courses' => Course::all(), 'classes' => StudentClass::all()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Exam::store(Exam::getDataFromRequest(Exam::getRequiredAttribute('post'), $request));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('teacher.exam.edit')->with([
            'exam' => Exam::find($id),
            'courses' => Course::all()
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
        $res = Exam::updateIt(Exam::getDataFromRequest(Exam::getRequiredAttribute('put'), $request), $id);
        if ($res["state"]) {
            return redirect()->back()->with('errors', $res['data']);
        }
        return redirect()->back()->with('success', 'Course updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::find($id)->delete();
        return redirect()->back()->with('success', 'Exam deleted !');
    }
}

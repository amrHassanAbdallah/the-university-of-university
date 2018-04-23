<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.registration.index')->with('registrations', Registration::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.registration.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = Registration::store(Registration::getDataFromRequest(Registration::getRequiredAttribute('post'),
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
        $reg = Registration::find($id);

        return view('admin.registration.edit')->with([
            'registration' => $reg,
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
        $res = Registration::updateIt(Registration::getDataFromRequest(Registration::getRequiredAttribute('put'),
            $request), $id);
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
        Registration::find($id)->delete();
        return redirect()->back()->with('success', 'Course deleted !');
    }
}

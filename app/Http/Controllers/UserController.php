<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct()
	{
		return $this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('admin.user.index')->with('users', User::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        $res = User::store(User::getDataFromRequest(User::getRequiredAttribute('post'), $request));
        if ($res["state"]) {
            return redirect()->back()->with('errors', $res['data']);
        }
        return redirect()->back()->with('success', 'User have been updated ');

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
		return view('admin.user.edit')->with('User', User::find($id));
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
        $res = User::updateUser(User::getDataFromRequest(User::getRequiredAttribute('put'), $request), $id);
        if ($res["state"]) {
            return redirect()->back()->with('errors', $res['data']);
        }
        return redirect()->back()->with('success', 'new user have been created');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
        User::find($id)->delete();
        return redirect()->back()->with('success', 'User deleted !');
	}
}

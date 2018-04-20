<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Auth::user()->level === "admin") {
			return view('admin.index');
		} elseif (Auth::user()->level === "student") {
			return view('student.index');
		} elseif (Auth::user()->level === "teacher") {
			return view('teacher.index');
		}
		return view('home');
	}
}

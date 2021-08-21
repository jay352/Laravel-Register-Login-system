<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {

		$id = \Auth::user()->id;

		$data = DB::table('users')->where('id', '=', $id)->first();
		if (isset($data)) {
			return view('home', compact('data'));
		} else {
			return view('home');
		}

	}

}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Validation\ValidationException;


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


		$id = Auth::user()->id;
		

		$data = DB::table('users')->join('tasks','users.id','=','tasks.user_id')->where('users.id', '=', $id)->get();
		if (isset($data)) {

		
			return view('home',['data'=>$data]);

		} else {
			return view('home');
		}

	}

public function ToggleTaskCompleteStatus($id)
{
    $task = Task::findOrFail($id);
    $task->update(['status' => ! $task->status]);
    return view ('home',['data'=>$data]);
  
}



}


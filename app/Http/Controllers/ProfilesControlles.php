<?php

namespace App\Http\Controllers;use App;

class ProfilesControlles extends Controller {
	public function index($user) {

		\App\User::find($user);
		return view('home', ['user' => $user]);
	}
}

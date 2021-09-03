<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class UserControll extends Controller
{
    private $sucess_status = 200;

     public function createUser(Request $request) {

        $validator      =       Validator::make($request->all(),
            [
                'name'          =>        'required',
                'email'               =>        'required|email',
                'password'            =>        'required|min:8'
            ]
        );

        if($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }

        $dataArray          =       array(
            "name"        =>          $request->name,
            "email"             =>          $request->email,
            "password"          =>          bcrypt($request->password),
      

        );

        $user               =               User::create($dataArray);

        if(!is_null($user)) {
            return response()->json(["status" => $this->sucess_status, "success" => true, "data" => $user]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! user not created. please try again."]);
        }
    }

    //login
     public function userLogin(Request $request) {

        $validator      =       Validator::make($request->all(),
            [
                'email'               =>        'required|email',
                'password'            =>        'required|alpha_num|min:5'
            ]
        );

        if($validator->fails()) {
            return response()->json(["validation_errors" => $validator->errors()]);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user       =       Auth::user();
            $token      =       $user->createToken('token')->accessToken;

            return response()->json(["status" => $this->sucess_status, "success" => true, "login" => true, "token" => $token, "data" => $user]);
        }
        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! invalid email or password"]);
        }
    }

}

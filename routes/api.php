<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

	
	Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});
	Route::post("create-user", "UserControll@createUser");
Route::post("user-login", "UserControll@userLogin");	

Route::group(['middleware' => 'auth:api'], function () {


Route::post("create-task", "TaskController@createTask");
Route::post("status-change", "TaskController@StatusUpdate");
Route::get("task/{task_id}","TaskController@task");
});
	

Route::post('postinsert', 'HomeController@ajaxRequestPost');
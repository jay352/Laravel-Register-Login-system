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

	
	
Route::post("user-login", "UserControll@userLogin");
Route::post("create-user", "UserControll@createUser");
Route::post("create-task", "TaskController@createTask");
Route::post("status-change", "TaskController@StatusUpdate");
Route::get("task/{task_id}","TaskController@task");

	

<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Task;


class TaskController extends Controller {

private $success_status = 200;


//create task

public function createTask(Request $request)
{


    $user = Auth::user();

    $validator = Validator::make($request->all(),
    [
        "task" => "required",
        
        "user_id"=>"required"
    ]
);

    if ($validator->fails()) {
        return response()->json(["validation_errors"=>$validator->errors()]);
    }

    $task_array = array("task"=>$request->task,
                        "user_id"=>$request->user_id);


   

        $task               =       Task::create($task_array);

        if(!is_null($task)) {
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $task, "message"=>"task successfully created"]);


           
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! task not created."]);
        }
    }


//changing status

    public function StatusUpdate(Request $request)
{
    $user = Auth::user();
    $validator = Validator::make($request->all(),
    [
        "id"=>"required",
        "status" => "required",
        
       
    ]
);
     if ($validator->fails()) {
        return response()->json(["validation_errors"=>$validator->errors()]);
    }


    $task_array = array("status"=>$request->status);

$task_id            =       $request->id;

        if($task_id != "") {
            $task_status    =       Task::where("id", $task_id)->update($task_array);

            if($task_status == 1) {
                return response()->json(["status" => $this->success_status, "success" => true, "message" => "Status cahnged successfullly", "data" => $task_array]);

            }
        

            else {
                return response()->json(["status" => $this->success_status, "success" => false, "message" => "Status not changed"]);
            }

        }

}
        //task status

        public function task($id) {
        if($id == 'undefined' || $id == "") {
            return response()->json(["status" => "failed", "success" => false, "message" => "Alert! enter the task id"]);
        }

        $task       =           Task::find($id);

        if(!is_null($task)) {
            return response()->json(["status" => $this->success_status, "success" => true, "data" => $task]);
        }

        else {
            return response()->json(["status" => "failed", "success" => false, "message" => "Whoops! no todo found"]);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        $tasks  =   $this->get();
        return view('tasks', compact('tasks'));
    }

    public function get(){
        return Task::all();
    }

    public function store(Request $request){
        $datetime               = explode(", ",$request->input('deadline'));
        $date                   = \Carbon\Carbon::createFromFormat('d/m/Y', $datetime[0])->format('Y-m-d');
        $time                   = date("H:i:s", strtotime($datetime[1]));

        $task                   =   new Task;
        $task->task_name        =   $request->input('name');
        $task->task_description =   $request->input('description');
        $task->deadline         =   \Carbon\Carbon::parse($date.' '.$time)->format('Y-m-d H:i');
        $task->timezone         =   $request->input('timezone');
        $task->status           =   0;
        $task->save();

        if($task){
            return redirect()->back()->with('success', "Task Created Succesfully !");
        }else{
            return redirect()->back()->with('fail', "Failed To Create Task !");
        }
    }

    public function done($id){
        $task           = Task::findOrFail($id);
        $task->status   =   1; 
        $task->save();

        if($task){
            return redirect()->back()->with('success', "Task ".$task->task_name." Finished Succesfully !");
        }else{
            return redirect()->back()->with('fail', "Failed To Finish ".$task->task_name." Task !");
        }
    }
}

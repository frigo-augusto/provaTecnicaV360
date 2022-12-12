<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Tasks;

class TasksController extends Controller
{
    public function create(Request $request){
        $task = new Tasks();
        $task->title = $request->title;
        $task->todo_id = $request->todo_id;
        $task->completed = false;
        $task->save();
        return $task;
    }

    public function completedChange(Request $request){
        $task = Tasks::find($request->id);
        $task->completed = !$task->completed;
        $task->save();
    }
}

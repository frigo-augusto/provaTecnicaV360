<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todo', ["todos" => $todos]);
    }

    public function create(Request $request){
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->difficulty = $request->difficulty;
        $todo->completed = false;
        $todo->save();
        return $todo;
    }

    public function completedChange(Request $request){
        $todo = Todo::find($request->id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }
}

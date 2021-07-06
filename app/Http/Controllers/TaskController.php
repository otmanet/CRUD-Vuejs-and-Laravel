<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $task=Task::all();
        return Response()->json([
        'tasks' => $task,
        ]);
    }
    public function AddTask(Request $request){
        $task=new Task();
        $task->name=$request->name;
        $task->save();
        return response()->json([
            'etat'=>true
        ]);
    }
    public function delete($id){
        $task=Task::find($id);
        $task->delete();
        return response()->json(['etat' => true]);
    }
     public function UpdateTask(Request $request){
     $task=Task::find($request->id);
     $task->name=$request->name;
     $task->save();
     return response()->json([
     'etat'=>true
     ]);
     }
}

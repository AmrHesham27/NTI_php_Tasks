<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index (){
        $data = Task::select('*');
        return view('/index', ['data' => $data]);
    }
    public function addTaskPage(){
        return view('/addTask');
    }
    public function addTaskAction(Request $request){
        $data = $this->validate($request,[
            "title"  => "required|string",
            "Describtion" => "required|string",
            "expiryDate" => "required|after:now" . date('Y-m-d')
            //"expiryDate" => "required|after:today"
        ]);
        Task::create($data);
        return redirect(url('/index'));
    }
    public function editTaskPage(){
        return view('/editTask');
    }
    public function editTaskAction(Request $request){
        $data = $this->validate($request,[
            "title"  => "required|string",
            "Describtion" => "required|string",
            "expiryDate" => "required|after:now" . date('Y-m-d'),
            "id" => "required"
        ]);
        Task::where('id', $data['id'])
        ->update(['title' => $data['title'], 'Describtion' => $data['Describtion'], 'expiryDate' => $data['expiryDate']]);
        return redirect(url('/index'));
    }
    public function deleteTask(Request $request){
        $data = $this->validate($request,[
            "id" => "required"
        ]);
        Task::where('id', $data['id'])->delete();
        return redirect(url('/index'));
    }
}

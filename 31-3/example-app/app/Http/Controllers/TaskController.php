<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->id();
        $data = Task::select('*')->where('addedBy', $id);
        return view('/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addTask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* public function store(Request $request)
    {
        $data = $this->validate($request,[
            "title"  => "required|string|min:6|max:40",
            "content" => "required|string|min:6|max:100",
            "image" => "mimes:jpeg,jpg,png,gif|required|max:10000",
            "startDate" => "required|after:today",
            "endDate" => "required|after:".$request->startDate,
        ]);
        $data['addedBy'] = auth()->id();
        $op = Task::create($data);
        $mssg = $op? 'Task was created successfully' : 'Error try again';
        session()->flash('mssg', $mssg);
        return redirect(url('/index'));
    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = auth()->id();
        $data = Task::select('*')->where('addedBy', $userId)->where('id', $id);
        return view('/editTask', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userId = auth()->id();
        $old_image = Task::select('image')->where(['id' => $id, 'addedBy' => $userId]);

        $data = $this->validate($request,[
            "title"  => "required|string",
            "content" => "required|string",
            "image" => "nullable|mimes:jpeg,jpg,png,gif|required|max:10000",
            "startDate" => "required",
            "endDate" => "required",
        ]);
        $data['addedBy'] = $userId;

        if($request->hasFile('image')){
            $FileName = time().rand().'.'.$request->image->extension();
            if($request->image->move(public_path('uploads'),$FileName)){
                $data['image'] =  $FileName;
                unlink(public_path('uploads/'.$old_image));
            };
        }
        else {
            $data['image'] = $old_image;
        };

        $op = Task::where('id', $id)->where('addedBy', $userId)->update($data);
        $mssg = $op? 'Task was edited successfully' : 'Error try again';
        session()->flash('mssg', $mssg);
        return redirect(url('/index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // can not delete task if end date is expired
        // this logic exist in a middleware

        $data = Task::find($id);
        $userId = auth()->id();
        $op = Task::where('id', $id)->where('addedBy', $userId)->delete();
        if($op){
            $mssg = 'Task was deleted successfully';
            unlink(public_path('uploads/'.$data->image));
        }
        else {
            $mssg = 'Error please try again';
        }
        session()->flash('mssg', $mssg);
        return redirect(url('/index'));
    }
}

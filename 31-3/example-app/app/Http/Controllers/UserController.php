<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            "name"  => "required|string|min:6|max:40",
            "email" => "required|email",
            "password" => ["required", Password::min(6)->letters(), "confirmed"],
        ]);
        $data['password'] = bcrypt($data['password']);
        $op = User::create(["name" => $data['name'], "email" => $data['email'], "password" => $data['password'],]);
        $mssg = $op ? 'You were registered successfully' : 'Error try again';
        session()->flash('mssg', $mssg);
        return redirect(url('/Task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userId = auth()->id();
        $data = User::select('*')->where('id', $userId);
        return view('/User/{id}/edit', $data);
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
        $data = $this->validate($request,[
            "name"  => "required|string",
            "email" => "required|string",
        ]);
        $userId = auth()->id();
        $op = User::where('id', $userId)->update(['name' => $data['name'], 'email' => $data['email']]);
        $mssg = $op? 'User was edited successfully' : 'Error try again';
        session()->flash('mssg', $mssg);
        return redirect(url('/Task'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /** Login Logout */
    public function loginPage(){
        return view('User.login');
    }
    public function loginAction(Request $request){
        $data = $this->validate($request,[
          "email"  => "required|email",
          "password" => ["required",Password::min(6)->letters()]
        ]);
        if(auth()->attempt($data)){
            session()->flash('mssg','You were logged in successfully');
            return  redirect(url('/Task'));
        }
        else {
            session()->flash('mssg','Email or Password is wrong, please try again');
            return redirect(url('/login'));
        }
    }
    public function logOut(){
        auth()->logout();
        return  redirect(url('/login'));
    }
}

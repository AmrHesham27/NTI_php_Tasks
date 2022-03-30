<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\Admin;

class AdminController extends Controller
{
    public function homePage(){
        return view('/home');
    }
    public function loginPage(){
        return view('/login');
    }

    public function loginAction(Request $request){
        $data = $this->validate($request,[
            "adminEmail"  => "required|email",
            "password" => "required"
        ]);
        if (auth()->attempt($data)) {
            return redirect(url('/home'));
        }
        else {
            session()->flash('Message','Email or Passwrod is wrong, please try again');
            return redirect(url('/home'));
        }
    }
    public function registerPage(){
        return view('/register');
    }
    public function registerAction(Request $request){
        $data =  $this->validate($request,[
            "adminEmail"     => "required|unique:admins",
            "password" => ["required", Password::min(6), "confirmed"]
        ]);
        $data['password'] = bcrypt($data['password']);

        $result = Admin::create($data);
        $message = $result? 'New Admin was registered successfully' : 'Error Try Again';
        session()->flash('Message',$message);
        return redirect(url('/home'));
    }
}

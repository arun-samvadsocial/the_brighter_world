<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class Authentication extends Controller
{
    public function register(Request $request){
        // sendMail('arun1601for@gmail.com','Test email','Arun test','');
    }

    public function login(Request $request){
        if(Session::get('user_id')){
            return redirect('/');
        }
        $method = $request->method();
        if ($request->isMethod('post')) {
            $user = User::where("email",$request->email)
            ->first();
            if (!$user) {
                
                return redirect()->back()->withErrors('Email id not found!');
             }
             if (!Hash::check($request->password, $user->password)) {
                
                return redirect()->back()->withErrors('Password not match!');
             }else if($user->status == 1) {
                session()->put('user_id',$user->id);
                session()->put('role',$user->role);
                return redirect('/');
             }else{
                return redirect()->back()->withErrors('Your account is not active');
             }

        }else{
            return view('Login');
        }
    }
    public function logout(){
        session()->forget('user_id');
        session()->forget('role');
        return redirect('/');
    } 
}

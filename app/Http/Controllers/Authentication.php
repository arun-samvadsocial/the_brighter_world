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
use Helper;

class Authentication extends Controller
{
    public function register(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "name"=>"required",
                    'email'=>'required|email|unique:users',
                    'mobile'=>'required|unique:users',
                    'password'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    $token = Str::random(150);
                    User::create([
                        "name"=>$request->name,
                        "email"=>$request->email,
                        "mobile"=>$request->mobile,
                        "password"=>Hash::make($request->password),
                        "role"=>"user",
                        "email_verification_code"=>$token,
                        "status"=>0
                    ]);
                    $url = url('/');
                    $link = $url."/verify/".$token;
                    $data['link']=$link;
                    $data['url']=$url;
                    $data['email']=$request->email;
                    $data['name']=$request->name;
                    $data['title']='Email verification';
                    $status = Helper::sendMail($request->email,$data['title'],$data,'Mails.verificationMail');
                    
                    return redirect('/register')->with("success","We have sent an verification mail to your email address please verify your email");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('/register')->withErrors('Something went wrong.');
                // echo "Error";
            }
        }else{
            return view('Register');
        }
    }

    public function verify($token=''){
        try{
            $check = User::where("email_verification_code", $token)->first();
            $token = Str::random(100);
            if($check){
                User::where("email", $check->email)
                ->update([
                    "status"=>1,
                    "email_verification_code"=>$token
                ]);
                return redirect('/register')->with("success","Your account successfully activated");
            }else{
                return redirect('/register')->withErrors('Verification link expired.');
            }
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('/register')->withErrors('Something went wrong.');
            // echo "Error";
        }
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
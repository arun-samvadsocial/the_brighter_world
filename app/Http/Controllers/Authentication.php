<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Session;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Helper;
use Carbon\Carbon;

class Authentication extends Controller
{
    //User register function start here
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
                    return redirect()->back()->withErrors($validator->errors())->withInput(); 
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
    

    //Verify user email with verification code function start here
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

    //User login function start here
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

    //User forget password function start here
    public function forget(Request $request){
        $method = $request->method();
        if ($request->isMethod('post')) {
            $email = $request->email;
            $user = User::where('email', $email)->first();                
            try{
                $email = $user->email;
                if($user){
                    $token = Str::random(150);
                    $url = url('/');
                    $link = $url."/confirmpass/?token=".$token;
                    $data['link']=$link;
                    $data['url']=$url;
                    $data['email']=$request->email;
                    $data['name']=$user->name;
                    $data['title']='Password Reset';
                    $status = Helper::sendMail($request->email,$data['title'],$data,'Mails.resetPasswordTemplate');
                    PasswordReset::updateOrCreate(
                        ['email'=>$email],[
                            'email'=>$request->email,
                            'token'=>$token,
                        ]
                    );
                    return redirect('/forget')->with("success","Password reset link successfully sent to your email.");
                }else{
                    return redirect('/forget')->withErrors('User not found.');
                }
    
            }catch(\Exception $e){
                // return dd($e);
                return redirect('/forget')->withErrors('Something went wrong.');
            }
        }else{
            return view('Forget'); 
        }
        
    }


    

    //User password change function start here
    public function confirmpass(Request $request){ 
        $method = $request->method();
        // return dd($request->all());
        if ($request->isMethod('post')) {
            $validator =  Validator::make($request->all(),[
                "password"=>"required|min:3|confirmed",
                "password_confirmation"=>"required|min:3|"
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput(); 
            }
            $check = PasswordReset::where('token',$request->token)->first();
            $email = $check->email;
            $update = User::where('email',$email)
            ->update([
                'password'=>Hash::make($request->password)
            ]);
            if($update > 0){
                $token = Str::random(50);
                PasswordReset::where('email',$email)
                ->update([
                    'token'=>$token
                ]);
                
                return redirect('/login')->with("success","Your password successfully changed.");
            }else{
                return redirect('/forget')->withErrors('Somethig went wrong.');
            }
        }else{
            return view('Confirmpass'); 
        }
        
    }


    //User logout function start here
    public function logout(){
        session()->forget('user_id');
        session()->forget('role');
        return redirect('/');
    } 
}
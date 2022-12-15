<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Admin\Users_model;
use App\Models\Admin\User_role_model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Mail;
use Session;
use Helper;
class Users extends Controller
{
    // User list
    public function index(Request $request){
        $search = urldecode($request->input('search'));
        try{
           
            $user = Helper::getUser();
                $data['users'] = Users_model::select("users.*","roles.role_name")
                ->leftJoin("roles", "users.role", "=", "roles.role")
                ->orWhere("users.name", 'LIKE',"%" . $search . "%")
                ->orWhere("users.email", 'LIKE',"%" . $search . "%")
                ->orWhere("users.mobile", 'LIKE',"%" . $search . "%")
                ->orWhere("users.role", 'LIKE',"%" . $search . "%")
                ->orderBy('users.created_at', 'desc')
                ->latest("users.created_at")
                ->paginate(10);

            return view('Admin.Users.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/user-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add User
    public function add_user(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "name"=>"required",
                    'email'=>'required|email|unique:users',
                    'mobile'=>'required||unique:users',
                    'user_role'=>'required',
                    'password'=>'required'
                ]);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput();; 
                }else{
                    Users_model::create([
                        "name"=>$request->name,
                        "email"=>$request->email,
                        "mobile"=>$request->mobile,
                        "role"=>$request->user_role,
                        "password"=>Hash::make($request->password)
                    ]);
                    return redirect('admin/user-list')->with("success","User successfully created");
                }
            }catch(\Exception $exception){
                dd($exception);
                // return redirect('admin/user-list')->withErrors('Exception Error');
                // echo "Error";
            }

            
        }else{
            try{
                $data['roles'] = User_role_model::get();
                return view('Admin.Users.Add-user')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/user-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    // Edit User
    public function editUser(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "name"=>"required",
                ]);
                if(isset($request->user_role) && $request->user_role != null){
                    $role = $request->user_role;
                }else{
                    $role = Helper::getUser()->role;
                }
                dd($role);

                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); 
                }else{
                Users_model::where("id",$request->id)
                ->update([
                    "name"=>$request->name,
                    "role"=>$request->user_role
                ]);
                return redirect('admin/user-list/')->with("success", "User updated");
            }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/user-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['user_data']=Users_model::where("id",$id)->first();
                $data['roles'] = User_role_model::get();
                return view('Admin.Users.Edit-user')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/user-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change User Status Active and Deactive
    public function changeUserStatus($id=''){
        try{
            $user = Users_model::where("id",$id)->first();
            if($user->status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Users_model::where("id",$id)
                ->update([
                    "status"=>$status
                ]);
            return redirect('admin/user-list')->with("success","User status updated");    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/user-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Videos_model;
use Illuminate\Support\Facades\Validator;

class Videos extends Controller
{
    // Video list
    public function index(){
        try{
            $data['videos'] = Videos_model::select("videos.*","users.email")
            ->leftJoin("users","videos.user_id", "=","users.id")
            ->get();
            return view('Admin.Videos.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/videos')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Video
    public function add_video(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "video_title"=>"required",
                    "video_url"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Videos_model::create([
                        "name"=>$request->video_title,
                        "video_url"=>$request->video_url,
                        "user_id"=>auth()->user()->id
                    ]);
                    return redirect('admin/videos')->with("success","Video added");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/videos')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Videos.Add-video');
        }
    }

    // Edit Video
    public function edit_video(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "video_title"=>"required",
                    "video_url"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Videos_model::where("id",$request->id)
                ->update([
                    "name"=>$request->video_title,
                    "video_url"=>$request->video_url,
                    "user_id"=>auth()->user()->id
                ]);
                return redirect('admin/videos')->with("success","Video updated");
            }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/videos')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['video_data']=Videos_model::where("id",$id)->first();
                return view('Admin.Videos.Edit-video')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/videos')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Video Status Active and Deactive
    public function changeVideoStatus($id=''){
        try{
            $videobtn = Videos_model::where("id",$id)->first();
            if($videobtn->status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Videos_model::where("id",$id)
                ->update([
                    "status"=>$status
                ]);
            return redirect('admin/videos')->with("success","Video status updated");  
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/videos')->withErrors('Exception Error');
            // echo "Error";
        }  
    }
}

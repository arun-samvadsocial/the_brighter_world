<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Tags_model;
use Illuminate\Support\Facades\Validator;
use Helper;
class Tags extends Controller
{
    // Tags list
    public function index(){
        try{
            $data['tags'] = Tags_model::get();
            return view('Admin.Tags.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/tags-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Tags
    public function add_tags(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "tag_name"=>"required|unique:tag"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Tags_model::create([
                        "tag_name"=>$request->tag_name
                    ]);
                    return redirect('admin/tags-list')->with("success","Tag created");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tags-list')->withErrors('Exception Error');
                // echo "Error";
            }
        
        }else{
            return view('Admin.Tags.Add-tags');
        }
    }

    // Edit Tags
    public function edit_tags(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "tag_name"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Tags_model::where("tag_id",$request->tag_id)
                ->update([
                    "tag_name"=>$request->tag_name
                ]);
                return redirect('admin/tags-list/')->with("success","Tag updated");
            }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tags-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['tag_data']=Tags_model::where("tag_id",$id)->first();
                return view('Admin.Tags.Edit-tags')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tags-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Tags Status Active and Deactive
    public function changeTagsStatus($id=''){
        try{
            $tags = Tags_model::where("tag_id",$id)->first();
            if($tags->tag_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Tags_model::where("tag_id",$id)
                ->update([
                    "tag_status"=>$status
                ]);
            return redirect('admin/tags-list')->with("success","Tag status updated");    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/tags-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}

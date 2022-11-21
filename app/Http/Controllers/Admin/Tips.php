<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Tips_model;
use Illuminate\Support\Facades\Validator;

class Tips extends Controller
{
    // Tips list
    public function index(){
        try{
            $data['tips'] = Tips_model::where('is_delete', 0)->latest()->get();
            return view('Admin.Tips.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/tips-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Tips
    public function add_tips(Request $request){
        if ($request->isMethod('post')) {
            try{
                //Validate Tip Form Fields
                $validator =  Validator::make($request->all(),[
                    "tip_title"=>"required",
                    'tip_author'=>'required',
                    'tip'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    //Upload 1st Tip Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_tip.png");
                    $filename= (time()."_tip.png");
                    file_put_contents(public_path()."/upload/".time()."_tip.png", $img_data1);
                    
                    //Upload Shareable Tip Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharetip.png");
                    file_put_contents(public_path()."/upload/".time()."_sharetip.png", $img_data_share1);

                    //Insert Tip Data Into Database
                    Tips_model::create([
                        "tip_title"=>$request->tip_title,
                        "author_name"=>$request->tip_author,
                        "tip_description"=>$request->tip,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "tip_status"=>1
                    ]);
                    //Success Message
                    return redirect('admin/tips-list')->with('success','Tip Successfully Created.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tips-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Tips.Add-tips');
        }
    }

    // Edit Tips
    public function edit_tips(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                //Validate Tip Form Fields
                $validator =  Validator::make($request->all(),[
                    "tip_title"=>"required",
                    'tip'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    //Upload 1st Tip Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_tip.png");
                    $filename= (time()."_tip.png");
                    file_put_contents(public_path()."/upload/".time()."_tip.png", $img_data1);
                    
                    //Upload Shareable Tip Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharetip.png");
                    file_put_contents(public_path()."/upload/".time()."_sharetip.png", $img_data_share1);

                    //Update Tip Data Into Database
                    Tips_model::where("tip_id",$request->id)
                    ->update([
                        "tip_title"=>$request->tip_title,
                        "author_name"=>$request->tip_author,
                        "tip_description"=>$request->tip,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "tip_status"=>1
                    ]);
                    //Success Message
                    return redirect('admin/tips-list')->with('success','Tip Successfully Updated.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tips-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['tip_data']=Tips_model::where("tip_id",$id)->where('is_delete',0)->first();
                return view('Admin.Tips.Edit-tips')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/tips-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Tips Status Active and Deactive
    public function changeTipsStatus($id=''){
        try{
            $tip = Tips_model::where("tip_id",$id)->first();
            if($tip->tip_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Tips_model::where("tip_id",$id)
                ->update([
                    "tip_status"=>$status
                ]);
            return redirect('admin/tips-list');   
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/tips-list')->withErrors('Exception Error');
            // echo "Error";
        } 
    }

    //Delete Tip
    public function deleteTip($id=''){
        try{
            $tip = Tips_model::where("tip_id",$id)->first();
            Tips_model::where("tip_id",$id)
                ->update([
                    "is_delete"=>1
                ]);
            return redirect('admin/tips-list')->withErrors('Tip Successfully Deleted.');
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/tips-list')->withErrors('Exception Error');
            // echo "Error";
        }  
    }
}

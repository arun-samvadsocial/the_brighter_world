<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Facts_model;
use Illuminate\Support\Facades\Validator;

use Helper;
class Facts extends Controller
{
    // Tips list
    public function index(Request $request){
        $search = urldecode($request->input('search'));
        try{
            $user = Helper::getUser();
            if($user->role == "admin" || $user->role == "moderator" ){
                $data['facts'] = Facts_model::orWhere('fact_title','LIKE',"%" . $search . "%")
                ->orWhere("fact", 'LIKE',"%" . $search . "%")
                ->orWhere("fact_author", 'LIKE',"%" . $search . "%")
                ->where("is_delete",0)
                ->orderBy('created_at', 'desc')
                ->latest("created_at")
                ->paginate(10);

            }else{  
                
                $data['facts'] = Facts_model::orWhere('fact_title','LIKE',"%" . $search . "%")
                ->orWhere("fact", 'LIKE',"%" . $search . "%")
                ->orWhere("fact_author", 'LIKE',"%" . $search . "%")
                ->where("is_delete",0)
                ->where("user_id",session()->get("user_id"))
                ->orderBy('created_at', 'desc')
                ->latest("created_at")
                ->paginate(10);

            }
            return view('Admin.Facts.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/facts-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Tips
    public function add_facts(Request $request){
        if ($request->isMethod('post')) {
            try{
                //Validate Tip Form Fields
                $validator =  Validator::make($request->all(),[
                    "fact_title"=>"required",
                    'fact_author'=>'required',
                    'fact'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    //Upload 1st Fact Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_fact.png");
                    $filename= (time()."_tip.png");
                    file_put_contents(public_path()."/upload/".time()."_fact.png", $img_data1);
                    
                    //Upload Shareable Fact Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharefact.png");
                    file_put_contents(public_path()."/upload/".time()."_sharefact.png", $img_data_share1);

                    //Insert Tip Data Into Database
                    Facts_model::create([
                        "fact_title"=>$request->fact_title,
                        "fact_author"=>$request->fact_author,
                        "fact"=>$request->fact,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "fact_status"=>1,
                        "user_id"=>session()->get("user_id")
                    ]);
                    //Success Message
                    return redirect('admin/facts-list')->with('success','Fact Successfully Created.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/facts-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Facts.Add-facts');
        }
    }

    // Edit Tips
    public function edit_facts(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                //Validate Tip Form Fields
                $validator =  Validator::make($request->all(),[
                    "fact_title"=>"required",
                    'fact'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    //Upload 1st Tip Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_fact.png");
                    $filename= (time()."_fact.png");
                    file_put_contents(public_path()."/upload/".time()."_fact.png", $img_data1);
                    
                    //Upload Shareable Tip Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharefact.png");
                    file_put_contents(public_path()."/upload/".time()."_sharefact.png", $img_data_share1);

                    //Update Tip Data Into Database
                    Facts_model::where("fact_id",$request->id)
                    ->update([
                        "fact_title"=>$request->fact_title,
                        "fact_author"=>$request->fact_author,
                        "fact"=>$request->fact,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "fact_status"=>1
                    ]);
                    //Success Message
                    return redirect('admin/facts-list')->with('success','Fact Successfully Updated.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/facts-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['fact_data']=Facts_model::where("fact_id",$id)->where('is_delete',0)->first();
                return view('Admin.Facts.Edit-facts')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/facts-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Tips Status Active and Deactive
    public function changeFactStatus($id=''){
        try{
            $fact = Facts_model::where("fact_id",$id)->first();
            if($fact->fact_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Facts_model::where("fact_id",$id)
                ->update([
                    "fact_status"=>$status
                ]);
            return redirect('admin/facts-list');   
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/facts-list')->withErrors('Exception Error');
            // echo "Error";
        } 
    }

    //Delete Tip
    public function deleteFact($id=''){
        try{
            $tip = Facts_model::where("fact_id",$id)->first();
            Facts_model::where("fact_id",$id)
                ->update([
                    "is_delete"=>1
                ]);
            return redirect('admin/facts-list')->withErrors('Fact Successfully Deleted.');
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/facts-list')->withErrors('Exception Error');
            // echo "Error";
        }  
    }
}

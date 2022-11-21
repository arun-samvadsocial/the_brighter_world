<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Buy_Buttons_model;
use Illuminate\Support\Facades\Validator;

class BuyButtons extends Controller
{
    // Buy Buttons list
    public function index(){
        try{
        $data['buy_buttons'] = Buy_Buttons_model::select("buy_buttons.*","users.email")
        ->leftJoin("users","buy_buttons.user_id", "=","users.id")
        ->get();
        return view('Admin.BuyButtons.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/buy-button-list')->withErrors('Exception Error');
            // echo "Error";
        }  
    }

    //Add Buy Buttons
    public function add_buy_button(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "buy_button_code"=>"required|unique:buy_buttons"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Buy_Buttons_model::create([
                        "buy_button_code"=>$request->buy_button_code,
                        "publish_date"=>date("Y-m-d h:i:s"),
                        "user_id"=>session()->get("user_id")?session()->get("user_id"):"0"
                    ]);
                    return redirect('admin/buy-button-list')->with("success","Buy Button Successfully Added");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/buy-button-list')->withErrors('Exception Error');
                // echo "Error";
            } 
        }else{
            return view('Admin.BuyButtons.Add-buy-button');
        }
    }

    // Edit Buy Buttons
    public function edit_buy_button(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "buy_button_code"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Buy_Buttons_model::where("id",$request->id)
                ->update([
                    "buy_button_code"=>$request->buy_button_code,
                    "user_id"=>session()->get("user_id")?session()->get("user_id"):"0"
                ]);
                return redirect('admin/buy-button-list')->with('success',"Buy Button Successfully Updated");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/buy-button-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['buy_button_data']=Buy_Buttons_model::where("id",$id)->first();
                return view('Admin.BuyButtons.Edit-buy-button')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/buy-button-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Buy Buttons Status Active and Deactive
    public function changeBuyButtonStatus($id=''){
        try{
            $buybtn = Buy_Buttons_model::where("id",$id)->first();
            if($buybtn->status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Buy_Buttons_model::where("id",$id)
                ->update([
                    "status"=>$status
                ]);
            return redirect('admin/buy-button-list')->with('success',"Status Successfully Updated");   
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/buy-button-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}

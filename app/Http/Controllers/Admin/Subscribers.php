<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subscribers_model;
use App\Models\Admin\Whatsapp_Subscribers_model;
use Illuminate\Support\Facades\Validator;


class Subscribers extends Controller
{
    // Email Subscribers list
    public function index(){
        try{
            $data['subscriber_data'] = Subscribers_model::get();
            return view('Admin.Subscribers.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/subscribers')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Email Subscribers
    public function add_subscribers(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "subscriber_email"=>"required|email|unique:email_subscribers"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Subscribers_model::create([
                        "subscriber_email"=>$request->subscriber_email,
                        "subscription_date"=>date('Y-m-d h:i:s')
                    ]);
                    return redirect('admin/subscribers')->with("success","Email subscriber successfully added");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Subscribers.Add-subscriber');
        }
    }

    // Edit Email Subscribers
    public function edit_subscribers(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "subscriber_email"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Subscribers_model::where("id",$request->id)
                ->update([
                    "subscriber_email"=>$request->subscriber_email,
                    "subscription_date"=>date('Y-m-d h:i:s')
                ]);
                return redirect('admin/subscribers')->with("success","Email subscriber updated");
            }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['subscriber_data']=Subscribers_model::where("id",$id)->first();
                return view('Admin.Subscribers.Edit-subscriber')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Email Subscribers Status Active and Deactive
    public function changeSubscriberStatus($id=''){
        try{
            $subs = Subscribers_model::where("id",$id)->first();
            if($subs->status == 1){
                $status = 0;
                $fieldname = "unsubscribe_date";
            }else{
                $status =1;
                $fieldname = "subscription_date";
            }

            Subscribers_model::where("id",$id)
                ->update([
                    "status"=>$status,
                    $fieldname=>date("Y-m-d h:i:s")
                ]);
            return redirect('admin/subscribers')->with("success","Subcription updated"); 
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/subscribers')->withErrors('Exception Error');
            // echo "Error";
        }   
    }


    /*|==============================================================================
      | Whatsapp Subscribers
      |=============================================================================*/

      // Whatsapp Subscribers list
    public function whatsapp_subscribers_list(){
        try{
            $data['whatsapp_subscriber_data'] = Whatsapp_Subscribers_model::paginate();
            return view('Admin.Subscribers.Whatsapp-subscriebrs')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/whatsapp-subscribers')->withErrors('Exception Error');
            // echo "Error";
        }
    }
    
    //Add Whatsapp Subscribers
    public function add_whatsapp_subscribers(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "whatsapp_mobile_no"=>"required|unique:whatsapp_subscribers"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Whatsapp_Subscribers_model::create([
                        "whatsapp_mobile_no"=>$request->whatsapp_mobile_no,
                        "subscription_date"=>date('Y-m-d h:i:s')
                    ]);
                    return redirect('admin/whatsapp-subscribers')->with("success","Whatsapp subscriber successfully added");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/whatsapp-subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Subscribers.Add-whatsapp-subscriber');
        }
    }

    // Edit Whatsapp Subscribers
    public function edit_whatsapp_subscribers(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                Whatsapp_Subscribers_model::where("id",$request->id)
                ->update([
                    "whatsapp_mobile_no"=>$request->whatsapp_mobile_no
                ]);
                return redirect('admin/whatsapp-subscribers')->with("success","Whatsapp subscriber updated");
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/whatsapp-subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['whatsapp_subscriber_data']=Whatsapp_Subscribers_model::where("id",$id)->first();
                return view('Admin.Subscribers.Edit-whatsapp-subscriber')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/whatsapp-subscribers')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Whatsapp Subscribers Status Active and Deactive
    public function changeWhatsappSubscriberStatus($id=''){
        try{
            $subs = Whatsapp_Subscribers_model::where("id",$id)->first();
            if($subs->status == 1){
                $status = 0;
                $fieldname = "unsubscribe_date";
            }else{
                $status =1;
                $fieldname = "subscription_date";
            }

            Whatsapp_Subscribers_model::where("id",$id)
                ->update([
                    "status"=>$status,
                    $fieldname=>date("Y-m-d h:i:s")
                ]);
            return redirect('admin/whatsapp-subscribers')->with("success","Whatsapp subscription updated");   
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/whatsapp-subscribers')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}

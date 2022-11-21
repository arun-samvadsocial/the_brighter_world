<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Quotes_model;
use Illuminate\Support\Facades\Validator;

class Quotes extends Controller
{
    // Quotes list
    public function index(){
        try{
            $data['quotes'] = Quotes_model::where('is_delete', 0)->latest()->paginate(10);
            return view('Admin.Quotes.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/quotes-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Quotes
    public function add_quotes(Request $request){
        if ($request->isMethod('post')) {
            try{
                //Validate Quotes Form Fields
                $validator =  Validator::make($request->all(),[
                    'quote_author'=>'required',
                    'quote'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    //Upload 1st Quotes Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_quote.png");
                    file_put_contents(public_path()."/upload/".time()."_quote.png", $img_data1);
                    
                    //Upload Shareable Quotes Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharequote.png");
                    file_put_contents(public_path()."/upload/".time()."_sharequote.png", $img_data_share1);

                    //Insert Quotes Data Into Database
                    Quotes_model::create([
                        "quote_author"=>$request->quote_author,
                        "quote"=>$request->quote,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "quote_status"=>1
                    ]);
                    //Success Message
                    return redirect('admin/quotes-list')->with('success','Quote Successfully Created.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/quotes-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Quotes.Add-quotes');
        }
    }

    // Edit Quotes
    public function edit_quotes(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                //Validate Quotes Form Fields
                $validator =  Validator::make($request->all(),[
                    'quote'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    //Upload 1st Quotes Image
                    $img_data = $request->img_data;
                    $img_data = str_replace('data:image/png;base64,', '', $img_data);
                    $img_data = str_replace(' ', '+', $img_data);
                    $img_data1 = base64_decode($img_data);
                    $path= ("/upload/".time()."_quote.png");
                    file_put_contents(public_path()."/upload/".time()."_quote.png", $img_data1);
                    
                    //Upload Shareable Quotes Image
                    $img_data_share = $request->img_data_share;
                    $img_data_share = str_replace('data:image/png;base64,', '', $img_data_share);
                    $img_data_share = str_replace(' ', '+', $img_data_share);
                    $img_data_share1 = base64_decode($img_data_share);
                    $path_share= ("/upload/".time()."_sharequote.png");
                    file_put_contents(public_path()."/upload/".time()."_sharequote.png", $img_data_share1);

                    //Update Quotes Data Into Database
                    Quotes_model::where("quote_id",$request->id)
                    ->update([
                        "quote_author"=>$request->quote_author,
                        "quote"=>$request->quote,
                        "img_data"=>$path,
                        "img_data_share"=>$path_share,
                        "quote_status"=>1
                    ]);
                    //Success Message
                    return redirect('admin/quotes-list')->with('success','Quote Successfully Updated.');
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/quotes-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['quote_data']=Quotes_model::where("quote_id",$id)->where('is_delete',0)->first();
                return view('Admin.Quotes.Edit-quotes')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/auotes-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Quotes Status Active and Deactive
    public function changeQuotesStatus($id=''){
        try{
            $quote = Quotes_model::where("quote_id",$id)->first();
            if($quote->quote_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Quotes_model::where("quote_id",$id)
                ->update([
                    "quote_status"=>$status
                ]);
            return redirect('admin/quotes-list');   
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/quotes-list')->withErrors('Exception Error');
            // echo "Error";
        } 
    }

    //Delete Quotes
    public function deleteQuotes($id=''){
        try{
            $tip = Quotes_model::where("quote_id",$id)->first();
            Quotes_model::where("quote_id",$id)
                ->update([
                    "is_delete"=>1
                ]);
            return redirect('admin/quotes-list')->withErrors('Quote Successfully Deleted.');
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/quotes-list')->withErrors('Exception Error');
            // echo "Error";
        }  
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Category_model;
use App\Models\Admin\Sub_category_model;
use Illuminate\Support\Facades\Validator;

class Category extends Controller
{
    // Category list
    public function index(){
        try{
            $data['category'] = Category_model::paginate(10);
            return view('Admin.Category.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/category-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Category
    public function add_category(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "category_name"=>"required|unique:category",
                    'category_keywords'=>'required',
                    'short_order_status'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); ; 
                }else{
                    Category_model::create([
                        "category_name"=>$request->category_name,
                        "category_keywords"=>$request->category_keywords,
                        "short_order_status"=>$request->short_order_status
                    ]);
                    return redirect('admin/category-list')->with("success","Category Successfully Created");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            return view('Admin.Category.Add-category');
        }
    }

    // Edit Category
    public function edit_category(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "category_name"=>"required|unique:category",
                    'category_keywords'=>'required',
                    'short_order_status'=>'required',
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Category_model::where("category_id",$request->id)
                ->update([
                    "category_name"=>$request->category_name,
                    "category_keywords"=>$request->category_keywords,
                    "short_order_status"=>$request->short_order_status
                ]);
                return redirect('admin/category-list/')->with("success","Category Successfully Updated");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['category_data']=Category_model::where("category_id",$id)->first();
                return view('Admin.Category.Edit-category')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Category Status Active and Deactive
    public function changeCategoryStatus($id=''){
        try{
            $category = Category_model::where("category_id",$id)->first();
            if($category->category_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Category_model::where("category_id",$id)
                ->update([
                    "category_status"=>$status
                ]);
            return redirect('admin/category-list')->with("success","Category Status Updated");    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/category-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }



    /*|=============================================================================================
    | Sub-Category Functions
    |===============================================================================================*/

    // Sub-Category list
    public function sub_category_list(){
        try{
            $data['sub_category'] = Sub_category_model::select("sub_category.*","category.category_name")
            ->leftJoin('category', 'sub_category.main_category', '=', 'category.category_id')
            ->get();
            return view('Admin.SubCategory.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/sub-category-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Sub-Category
    public function add_sub_category(Request $request){
        if ($request->isMethod('post')) {
            try{
                $validator =  Validator::make($request->all(),[
                    "main_category"=>"required",
                    "sub_category_name"=>"required|unique:sub_category",
                    "sub_category_keywords"=>"required",
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    Sub_category_model::create([
                        "sub_category_name"=>$request->sub_category_name,
                        "sub_category_keywords"=>$request->sub_category_keywords,
                        "main_category"=>$request->main_category
                    ]);
                    return redirect('admin/sub-category-list')->with("success","Sub-category successfully created");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/sub-category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['category'] = Category_model::get();
                return view('Admin.SubCategory.Add-sub-category')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/sub-category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    // Edit Sub-Category
    public function edit_sub_category(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "main_category"=>"required",
                    "sub_category_name"=>"required|unique:sub_category",
                    "sub_category_keywords"=>"required",
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                Sub_category_model::where("sub_category_id",$request->id)
                ->update([
                    "sub_category_name"=>$request->sub_category_name,
                    "sub_category_keywords"=>$request->sub_category_keywords,
                    "main_category"=>$request->main_category
                ]);
                return redirect('admin/sub-category-list/')->with("success","Sub-category updated");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/sub-category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['category'] = Category_model::get();
                $data['sub_category_data']=Sub_category_model::where("sub_category_id",$id)->first();
                return view('Admin.SubCategory.Edit-sub-category')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/sub-category-list')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }

    //Change Sub-Category Status Active and Deactive
    public function changeSubCategoryStatus($id=''){
        try{
            $sub_category = Sub_category_model::where("sub_category_id",$id)->first();
            if($sub_category->sub_category_status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Sub_category_model::where("sub_category_id",$id)
                ->update([
                    "sub_category_status"=>$status
                ]);
            return redirect('admin/sub-category-list')->with("success","Sub-category status updated");    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/sub-category-list')->withErrors('Exception Error');
            // echo "Error";
        }
    }

}

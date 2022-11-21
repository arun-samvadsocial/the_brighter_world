<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Posts_model;
use App\Models\Admin\Category_model;
use App\Models\Admin\Cat_post;
use App\Models\Admin\Sub_category_model;
use Illuminate\Support\Facades\Validator;
use DateTime;

class Posts extends Controller
{
     // Category list
     public function index(){
        try{
            $user = getUser();
            if($user->role == "admin" || $user->role == "moderator" ){
                $data['posts'] = Posts_model::where('is_delete', 0)->with('Category')->latest()->paginate(10);

                // $data = Posts_model::where('is_delete', 0)->latest()->get();
                // foreach($data as $row){
                //     $post = Posts_model::where('post_id', $row->post_id)->first();
                //     if(isset($post)){
                //         $dt = new DateTime("@$post->publish_date");  // convert UNIX timestamp to PHP DateTime
                //         $date = $dt->format('Y-m-d H:i:s');
                //         Posts_model::where('post_id', $post->post_id)
                //         ->update([
                //             "published_date"=>$date
                //         ]);
                //     }
                    
                // }

            }else{
                
                $data['posts'] = Posts_model::where('is_delete', 0)
                ->where("user_id",session()->get("user_id"))
                ->with('Category')->latest()->paginate(10);

            }

            return view('Admin.Posts.index')->with($data);
            
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/all-posts')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Add Category
    public function add_single_post(Request $request){
        if ($request->isMethod('post')) {
            // dd($request->all());
            try{
                $validator =  Validator::make($request->all(),[
                    "post_title"=>"required",
                    'category_id'=>'required',
                    'published_date'=>'required',
                    'post_image'=>'required',
                    'img_source'=>'required',
                    'editor1'=>'required',
                ]);
                if($validator->fails()){
                    
                    return redirect()->back()->withErrors($validator->errors())->withInput(); 
                }else{
                    // $category_id = "";
                    // $i =0;
                    // foreach($request->category_id as $cat_row){
                    //     $category_id .= $cat_row[$i].',';
                    // }
                    $post_url = slugify($request->post_title); 
                    
                    $img_path = $request->file('post_image');
                    $logo_fileName = time().trim($img_path->getClientOriginalName());
                    $final_path = '/upload/'.$logo_fileName;
                    $img_path->move(public_path().'/upload/', $logo_fileName);

                    
                    $post_status = 1;
                    if(getUser()->role == "author"){
                        $post_status = 0;
                    }
                    Posts_model::create([
                        "title"=>$request->post_title,
                        "author"=>isset(getUser()->name)?getUser()->name:'',
                        "synopsis"=>$request->synopsis,
                        "hashtags"=>$request->keywords,
                        "description"=>$request->editor1,
                        "img_path"=>$final_path!=""?$final_path:"",
                        "thumb_img_path"=>$final_path!=""?$final_path:"",
                        "img_source"=>$request->img_source,
                        "post_url"=>$post_url!=""?$post_url:"",
                        "category_id"=>$request->category_id,
                        "status"=>$post_status,
                        "user_id"=>isset(getUser()->id)?getUser()->id:'',
                        "push_send_flag"=>$request->notify==1?$request->notify:0,
                        "video_link"=>$request->video_link,
                        "published_date"=>$request->published_date
                    ]);
                    return redirect('admin/all-posts')->with("success","Post Successfully Created");
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/all-posts')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            $data['category'] = Category_model::where('category_status',1)->with('subcategory')->get();
            return view('Admin.Posts.Add-post')->with($data);
        }
    }

    // Edit Sub-Category
    public function edit_post(Request $request,$id=""){
        if($request->isMethod('post')){
            try{
                $validator =  Validator::make($request->all(),[
                    "post_title"=>"required",
                    'category_id'=>'required',
                    'editor1'=>'required',
                    'img_source'=>'required'
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput(); 
                }else{
                    // $category_id = "";
                    // $i =0;
                    // foreach($request->category_id as $cat_row){
                    //     $category_id .= $cat_row[$i].',';
                    // }
                    $post_url = slugify($request->post_title); 

                    if($request->post_image != null){
                        $img_path = $request->file('post_image');
                        $logo_fileName = time().trim($img_path->getClientOriginalName());
                        $final_path = '/upload/'.$logo_fileName;
                        $img_path->move(public_path().'/upload/', $logo_fileName);
                        Posts_model::where("post_id",$request->id)
                        ->update([
                                "title"=>$request->post_title,
                                "author"=>isset(getUser()->name)?getUser()->name:'',
                                "synopsis"=>$request->synopsis,
                                "hashtags"=>$request->keywords,
                                "description"=>$request->editor1,
                                "img_path"=>$final_path!=""?$final_path:"",
                                "thumb_img_path"=>$final_path!=""?$final_path:"",
                                "img_source"=>$request->img_source,
                                "post_url"=>$post_url!=""?$post_url:"",
                                "category_id"=>$request->category_id,
                                "push_status"=>1,
                                "user_id"=>isset(getUser()->id)?getUser()->id:'',
                                "video_link"=>$request->video_link
                        ]);
                    }else{
                        
                        Posts_model::where("post_id",$request->id)
                        ->update([
                                "title"=>$request->post_title,
                                "author"=>isset(getUser()->name)?getUser()->name:'',
                                "synopsis"=>$request->synopsis,
                                "hashtags"=>$request->keywords,
                                "description"=>$request->editor1,
                                "img_source"=>$request->img_source,
                                "post_url"=>$post_url!=""?$post_url:"",
                                "category_id"=>$request->category_id,
                                "push_status"=>1,
                                "user_id"=>isset(getUser()->id)?getUser()->id:'',
                                "video_link"=>$request->video_link
                        ]);
                    }
               
                return redirect('admin/all-posts/')->with("success","Post Successfuly updated");
                }
            }catch(\Exception $exception){
                dd($exception);
                // return redirect('admin/all-posts')->withErrors('Exception Error');
                // echo "Error";
            }
        }else{
            try{
                $data['category'] = Category_model::where('category_status',1)->get();
                $data['post_data']=Posts_model::where("post_id",$id)->first();
                return view('Admin.Posts.Edit-post')->with($data);
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('admin/all-posts')->withErrors('Exception Error');
                // echo "Error";
            }
        }
    }





    //Change Category Status Active and Deactive
    public function changePostStatus($id=''){
        try{
            $post = Posts_model::where("post_id",$id)->first();
            if($post->status == 1){
                $status = 0;
            }else{
                $status =1;
            }
            Posts_model::where("post_id",$id)
                ->update([
                    "status"=>$status
                ]);
            return redirect('admin/all-posts')->with("success","Post Status Updated");    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/all-posts')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}

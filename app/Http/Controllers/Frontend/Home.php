<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Post_model;
use App\Models\Frontend\Category_model;
use App\Models\Frontend\Comment_model;
use Illuminate\Support\Facades\Validator;
class Home extends Controller
{
    public function index(){
        $data['category']= Category_model::where("category_status",1)
        ->latest()
        ->get();
        return view("Frontend.Home.index")->with($data);
    }

    public function post_detail($post_title,$post_id){
        $post_id = base64url_decode($post_id);
        $data['post_data'] = Post_model::where("post_id",$post_id)
        ->with("category")
        ->where("is_delete",0)
        ->where("status",1)
        ->first();
        return view("Frontend.Home.detail")->with($data);
    }

    public function category_post($category_name, $category_id){
        $category_id = base64url_decode($category_id);
        $data['posts'] = Post_model::where("category_id",$category_id)
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('post_id', 'desc')
        ->paginate(9);
        return view("Frontend.Home.category")->with($data);
    }

    public function author_post($author,$author_id){
        $author_id = base64url_decode($author_id);
        $data['posts'] = Post_model::where("user_id",$author_id)
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('post_id', 'desc')
        ->paginate(9);
        return view("Frontend.Home.author")->with($data);
    }
    // Comment_model
    public function comment_add(Request $request){
        $id = $request->id;
        $name = "";
        $email = "";
        if(getUser()){
            $name = getUser()->name;
            $email = getUser()->email;
        }
        try{
            $validator =  Validator::make($request->all(),[
                "comment"=>"required"
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors()); 
            }else{
                
                Comment_model::create([
                    "comment"=>$request->comment,
                    "name"=>$name,
                    "email"=>$email,
                    "post_id"=>$id
                ]);
                return redirect()->back()->with("success","Successfully commented");
            }
        }catch(\Exception $exception){
            dd($exception);
            // return redirect('/')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    public function about_us(){
        return view("Frontend.Home.about");
    }

    public function contact(){
        return view("Frontend.Home.contact");
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Post_model;
use App\Models\Frontend\Category_model;
use App\Models\Frontend\Comment_model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Helper;
class Home extends Controller
{
    public function index(){
        $data['category']= Category_model::where("category_status",1)
        ->latest()
        ->get();
        return view("Frontend.Home.index")->with($data);
    }

    public function post_detail($post_title,$post_id){
        $post_id = Helper::base64url_decode($post_id);
        $data['post_data'] = Post_model::where("post_id",$post_id)
        ->with("category")
        ->where("is_delete",0)
        ->where("status",1)
        ->first();
        return view("Frontend.Home.detail")->with($data);
    }

    public function category_post($category_name, $category_id){
        $category_id = Helper::base64url_decode($category_id);
        $data['posts'] = Post_model::where("category_id",$category_id)
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('published_date', 'desc')
        ->latest("published_date")
        ->paginate(9);
        return view("Frontend.Home.category")->with($data);
    }
    // Fetch Post Using Hashtags 
    public function tags_post($tag_name){
        $tag_name = urldecode($tag_name);
        $data['posts'] = Post_model::where('hashtags','LIKE',"%{$tag_name}%")
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('published_date', 'desc')
        ->latest("published_date")
        ->paginate(9);
        return view("Frontend.Home.tags")->with($data);
    }
    // Fetch Post Using Search Query 
    public function search_post(Request $request){
        $search_data = urldecode($request->input('search'));
        $data['posts'] = Post_model::where('title','LIKE',"%" . $search_data . "%")
        ->orWhere("synopsis", 'LIKE',"%" . $search_data . "%")
        ->orWhere("hashtags", 'LIKE',"%" . $search_data . "%")
        ->orWhere("author", 'LIKE',"%" . $search_data . "%")
        ->orWhere("keywords", 'LIKE',"%" . $search_data . "%")
        ->with('active_category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('published_date', 'desc')
        ->latest("published_date")
        ->paginate(9);
        return view("Frontend.Home.search")->with($data);
    }

    //Author post
    public function author_post($author,$author_id){
        $author_id = Helper::base64url_decode($author_id);
        $data['posts'] = Post_model::where("user_id",$author_id)
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->orderBy('published_date', 'desc')
        ->latest("published_date")
        ->paginate(9);
        return view("Frontend.Home.author")->with($data);
    }

    //Archives Post
    public function archives_post($year,$month){
        $posts['posts'] = Post_model::where( DB::raw('YEAR(published_date)'), '=', $year )
        ->where(DB::raw('MONTHNAME(published_date)'), '=', $month )
        ->with('category')
        ->leftJoin("category", "category.category_id", "=","post.category_id")
        ->where("category.category_status", "1")
        ->latest("published_date")
        ->paginate(9);
        return view("Frontend.Home.archives")->with($posts);
    }

    // Comment_model
    public function comment_add(Request $request){
        $id = $request->id;
        $name = "";
        $email = "";
        if(Helper::getUser()){
            $name = Helper::getUser()->name;
            $email = Helper::getUser()->email;
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

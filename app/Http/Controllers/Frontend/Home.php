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

    public function category_post(Request $request, $category_name, $category_id){
        $category_id = Helper::base64url_decode($category_id);
        $posts = Post_model::select("post.*","category.category_name")
        ->leftJoin("category", "category.category_id", "=","post.category_id")
        ->where("post.category_id",$category_id)
        ->where("post.is_delete",0)
        ->where("post.status",1)
        ->orderBy('post.published_date', 'desc')
        ->paginate(9);

        if($request->ajax()){
            $view = view("Frontend.Home.post-data", compact("posts"))->render();
            return response()->json(['html'=>$view]);
        }
        return view("Frontend.Home.category",compact("posts"));
    }
    // Fetch Post Using Hashtags 
    public function tags_post(Request $request, $tag_name){
        $tag_name = urldecode($tag_name);
        $posts = Post_model::select("post.*","category.category_name")
        ->where('post.hashtags','LIKE',"%{$tag_name}%")
        ->leftJoin("category", "category.category_id", "=","post.category_id")
        ->where("post.is_delete",0)
        ->where("post.status",1)
        ->orderBy('post.published_date', 'desc')
        ->paginate(9);
        if($request->ajax()){
            $view = view("Frontend.Home.post-data", compact("posts"))->render();
            return response()->json(['html'=>$view]);
        }
        return view("Frontend.Home.tags",compact("posts"));
    }
    // Fetch Post Using Search Query 
    public function search_post(Request $request){
        $search_data = urldecode($request->input('search'));
        $posts = Post_model::select("post.*","category.category_name")
        ->where('post.title','LIKE',"%" . $search_data . "%")
        ->orWhere("post.synopsis", 'LIKE',"%" . $search_data . "%")
        ->orWhere("post.hashtags", 'LIKE',"%" . $search_data . "%")
        ->orWhere("post.author", 'LIKE',"%" . $search_data . "%")
        ->orWhere("post.keywords", 'LIKE',"%" . $search_data . "%")
        ->with('category')
        ->leftJoin("category","post.category_id","=","category.category_id")
        ->orWhere("category.category_name", 'LIKE',"%" . $search_data . "%")
        ->where("post.is_delete",0)
        ->where("post.status",1)
        ->orderBy('post.published_date', 'desc')
        ->paginate(9);

        if($request->ajax()){
            $view = view("Frontend.Home.post-data", compact("posts"))->render();
            return response()->json(['html'=>$view]);
        }
        return view("Frontend.Home.search",compact("posts"));
    }

    //Author post
    public function author_post(Request $request, $author,$author_id){
        $author_id = Helper::base64url_decode($author_id);
        $posts = Post_model::select("post.*","category.category_name")
        ->leftJoin("category", "category.category_id", "=","post.category_id")
        ->where("post.user_id",$author_id)
        ->with('category')
        ->where("post.is_delete",0)
        ->where("post.status",1)
        ->orderBy('post.published_date', 'desc')
        ->paginate(9);

        if($request->ajax()){
            $view = view("Frontend.Home.post-data", compact("posts"))->render();
            return response()->json(['html'=>$view]);
        }
        return view("Frontend.Home.author",compact("posts"));
    }

    //Archives Post
    public function archives_post(Request $request, $year,$month){
        $posts = Post_model::where( DB::raw('YEAR(published_date)'), '=', $year )
        ->where(DB::raw('MONTHNAME(published_date)'), '=', $month )
        ->with('category')
        ->leftJoin("category", "category.category_id", "=","post.category_id")
        ->where("category.category_status", "1")
        ->orderBy('published_date', 'desc')
        ->paginate(9);

        if($request->ajax()){
            $view = view("Frontend.Home.post-data", compact("posts"))->render();
            return response()->json(['html'=>$view]);
        }
        return view("Frontend.Home.archives",compact("posts"));
    }

    // Comment_model
    public function comment_add(Request $request){
        $id = $request->id;
        $name = "";
        $email = "";
        if(auth()->user()){
            
            $name = auth()->user()->name;
            $email = auth()->user()->email;
            try{
                $validator =  Validator::make($request->all(),[
                    "comment"=>"required"
                ]);
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors()); 
                }else{
                    //Add new code //////////////////////
                    $check = Post_model::where("post_id",$request->id)->first();
                    if($check){
                        Comment_model::create([
                            "comment"=>$request->comment,
                            "name"=>$name,
                            "email"=>$email,
                            "post_id"=>$id
                        ]);
                        return redirect()->back()->with("success","Successfully commented");
                    }else{
                        return redirect()->back()->withErrors('Post not found');
                    }
                    ///////////////////////////////////////////////
                    
                }
            }catch(\Exception $exception){
                // dd($exception);
                return redirect('/')->withErrors('Somethig went wrong');
                // echo "Error";
            }
        }
        
    }

    public function about_us(){
        return view("Frontend.Home.about");
    }

    public function contact(){
        return view("Frontend.Home.contact");
    }
}

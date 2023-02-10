<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Comments_m;
use Helper;
class Comments_ extends Controller
{
    // Comment list
    public function index(Request $request){
        $search = urldecode($request->input('search'));
        try{
          
            $user = auth()->user();
            if($user->role == "admin" || $user->role == "moderator" ){
                $data['comment'] = Comments_m::select("comment.*","post.title")
                ->leftJoin("post", "post.post_id", "=","comment.post_id")
                ->orWhere("comment.name", 'LIKE',"%" . $search . "%")
                ->orWhere("comment.email", 'LIKE',"%" . $search . "%")
                ->orWhere("comment.comment", 'LIKE',"%" . $search . "%")
                ->orWhere("post.title", 'LIKE',"%" . $search . "%")
                ->where("is_delete",0)
                ->orderBy('created_at', 'desc')
                ->latest("created_at")
                ->paginate(10);

            }else{  
                
                $data['comment'] = Comments_m::select("comment.*","post.title")
                ->leftJoin("post", "post.post_id", "=","comment.post_id")
                ->orWhere("comment.name", 'LIKE',"%" . $search . "%")
                ->orWhere("comment.email", 'LIKE',"%" . $search . "%")
                ->orWhere("comment.comment", 'LIKE',"%" . $search . "%")
                ->orWhere("post.title", 'LIKE',"%" . $search . "%")
                ->where("is_delete",0)
                ->orderBy('created_at', 'desc')
                ->latest("created_at")
                ->where("post.user_id",auth()->user()->id)
                ->paginate(10);

            }

            return view('Admin.Comment.index')->with($data);
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/')->withErrors('Exception Error');
            // echo "Error";
        }
    }

    //Change Comment Status Active and Deactive
    public function changeCommentStatus($id=''){
        try{
            $comment = Comments_m::where("id",$id)->first();
            if($comment->approve_flag == 1){
                $status = 0;
                $msg = "Comment Successfully Unapproved";
            }else{
                $status =1;
                $msg = "Comment Successfully Approved";
            }
            Comments_m::where("id",$id)
                ->update([
                    "approve_flag"=>$status
                ]);
            return redirect('admin/comments')->with("success",$msg);    
        }catch(\Exception $exception){
            // dd($exception);
            return redirect('admin/comments')->withErrors('Exception Error');
            // echo "Error";
        }
    }
}

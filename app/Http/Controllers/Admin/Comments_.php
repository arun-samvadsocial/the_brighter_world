<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Comments_m;
class Comments_ extends Controller
{
    // Comment list
    public function index(){
        try{
            $data['comment'] = Comments_m::select("comment.*","post.title")
            ->leftJoin("post", "post.post_id", "=","comment.post_id")
            ->latest()->paginate(10);
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

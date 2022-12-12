<?php

namespace App\Helpers;
use DateTime;
use App\Models\Frontend\Post_model;
use App\Models\User;
use App\Models\Frontend\Category_model;
use App\Models\Frontend\Comment_model;
use Illuminate\Support\Facades\DB;
use Mail;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
class Helper
{
    
    public static function slugify($data){
        $string=preg_replace('/[ ]/','-', $data );
        $final_slug=preg_replace('@[^a-zA-Z0-9-\x{0900}-\x{097F}]@u','', $string);
        return $final_slug;
    }

    public static function formatDate($date){
        $formatted_date = strtotime($date);
        return date('j M Y', $formatted_date);
    }

    public static function getPosts($cat_id,$limit=null){
        $post =  Post_model::where("category_id",$cat_id)
        ->limit($limit)
        ->where("is_delete",0)
        ->where("status",1)
        ->latest()
        ->get();
        return $post;
    }

    public static function getTrendingPosts($limit = null){
        $date = \Carbon\Carbon::today()->subDays(7);
        $post =  Post_model::select("post.*", "category.category_name")
        ->where("is_delete",0)
        ->limit($limit)
        ->with('category')
        ->where("status",1)
        ->leftJoin("category","post.category_id","=","category.category_id")
        ->where("category.category_status",1)
        ->where('post.published_date','>=',$date)
        ->orderBy('post_view_count', 'desc')
        ->get();
        return $post; 
    }

    public static function getArchives($cat_id=null){
        $results = DB::table('post')
                    ->select(DB::raw("DATE_FORMAT(`published_date`, '%Y') AS YEAR"),
                        DB::raw("DATE_FORMAT(`published_date`, '%M') AS MONTHNAME"),
                        DB::raw("DATE_FORMAT(`published_date`, '%m') AS MONTH"),
                        DB::raw("Count(*) as TOTAL")
                    )
                    ->leftJoin("category", "category.category_id", "=","post.category_id")
                    ->where("category.category_status", "1")
                    ->groupBy('YEAR','MONTHNAME','MONTH')
                    ->orderBy('YEAR','DESC')
                    ->orderBy('MONTH','DESC')

                    ->get();

                    
        return $results;
    }

    public static function getUser(){
        $user =  User::where("id",session()->get("user_id"))
        ->first();
        return $user;
    }

    public static function getPostsByAuthor($author_id,$limit){
        $post =  Post_model::where("user_id",$author_id)
        ->limit($limit)
        ->with('category')
        ->where("is_delete",0)
        ->where("status",1)
        ->latest()
        ->get();
        return $post;
    }

    public static function updateViewCount($post_id){
        $post_data = Post_model::where("post_id",$post_id)->first();
        $post_view_count = $post_data->post_view_count;
        $post =  Post_model::where("post_id",$post_id)
        ->update([
            'post_view_count'=>$post_view_count+1
        ]
        );
        return $post;
    }

    public static function getCategory($limit){
        $post =  Category_model::where("category_status",1)
        ->orderBy("short_order_status", "asc")
        ->limit($limit)
        ->get();
        return $post;
    } 

    public static function getComments($post_id){
        $comment =  Comment_model::where("post_id",$post_id)
        ->where("approve_flag",1)
        ->orderBy("id", "desc")
        ->get();
        return $comment;
    }



    public static function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public static function day_ago($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


    public static function sendmail($to,$subject,$data,$template){
            $data1=['data'=>$data];
            $user['to']=$to;
            $user['subject']=$subject;
            Mail::send($template==''?'Mails.simple':$template,$data1,
            function($messages) use
            ($user){
                $messages->to($user['to']);
                $messages->subject($user['subject']);
            });
            if (Mail::failures()) {
                return false;
            } else {
                return true;
            }
    }



    public static function getClientIps(){
        $ipaddress = '';
       if (isset($_SERVER['HTTP_CLIENT_IP']))
           $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
       else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_X_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
       else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_FORWARDED'];
       else if(isset($_SERVER['REMOTE_ADDR']))
           $ipaddress = $_SERVER['REMOTE_ADDR'];
       else
           $ipaddress = 'UNKNOWN';    
       return $ipaddress;
    } 

    public static function loadajax(){
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>';
    }

// ==============================================================================================
// Start CopyScape Plagiarism Checker Steps Funtions
// ==============================================================================================

    

}
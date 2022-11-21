<?php

function slugify($data){
    $string=preg_replace('/[ ]/','-', $data );
    $final_slug=preg_replace('@[^a-zA-Z0-9-\x{0900}-\x{097F}]@u','', $string);
    return $final_slug;
}

function formatDate($date){
    $formatted_date = strtotime($date);
    return date('j M Y', $formatted_date);
}


function getPosts($cat_id,$limit=null){
    $post =  \App\Models\Frontend\Post_model::where("category_id",$cat_id)
    ->limit($limit)
    ->where("is_delete",0)
    ->where("status",1)
    ->latest()
    ->get();
    return $post;
}
function getUser(){
    $user =  \App\Models\User::where("id",session()->get("user_id"))
    ->first();
    return $user;
}

function getPostsByAuthor($author_id,$limit){
    $post =  \App\Models\Frontend\Post_model::where("user_id",$author_id)
    ->limit($limit)
    ->with('category')
    ->where("is_delete",0)
    ->where("status",1)
    ->latest()
    ->get();
    return $post;
}

function updateViewCount($post_id){
    $post_data = \App\Models\Frontend\Post_model::where("post_id",$post_id)->first();
    $post_view_count = $post_data->post_view_count;
    $post =  \App\Models\Frontend\Post_model::where("post_id",$post_id)
    ->update([
        'post_view_count'=>$post_view_count+1
    ]
    );
    return $post;
}

function getCategory($limit){
    $post =  \App\Models\Frontend\Category_model::where("category_status",1)
    ->orderBy("short_order_status", "desc")
    ->limit($limit)
    ->get();
    return $post;
}

function getComments($post_id){
    $comment =  \App\Models\Frontend\Comment_model::where("post_id",$post_id)
    ->where("approve_flag",1)
    ->orderBy("id", "desc")
    ->get();
    return $comment;
}



function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function day_ago($datetime, $full = false) {
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


function sendmail($to,$subject,$data,$template){
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
?>
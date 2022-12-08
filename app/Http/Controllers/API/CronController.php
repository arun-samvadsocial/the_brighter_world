<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTime;
use Helper;
use App\Models\Admin\Posts_model;
class CronController extends Controller
{
    public function checkScheduledPost(){
        try{
            $posts = Posts_model::where("scheduled_status", 3)->get();
            foreach($posts as $row){
                $published_date = date('Y-m-d', strtotime($row->published_date));
                $today_date = date('Y-m-d');
                $today_date = strtotime($today_date);
                $published_date = strtotime($published_date);
                if ($today_date == $published_date){
                    Posts_model::where("scheduled_status", 3)
                    ->where("post_id",$row->post_id)
                    ->update([
                        "status"=>1
                    ]);
                }
            }
        }catch(\Exception $exception){
            // dd($exception);
            echo "Something went wrong";
        }
    }
}
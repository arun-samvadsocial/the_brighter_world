<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use Helper;
use App\Models\Admin\Posts_model;
class CheckPostCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkpostcron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
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

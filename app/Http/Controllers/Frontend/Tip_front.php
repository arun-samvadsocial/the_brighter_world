<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Tip_model;
class Tip_front extends Controller
{
    public function index(){
        $data['tips'] = Tip_model::where("is_delete",0)
        ->where("tip_status",1)
        ->latest()
        ->paginate(9);
        return view("Frontend.Tip.index")->with($data);
    }
}

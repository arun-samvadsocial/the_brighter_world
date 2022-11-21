<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Fact_model;
class Fact_front extends Controller
{
    public function index(){
        $data['facts'] = Fact_model::where("is_delete",0)
        ->where("fact_status",1)
        ->latest()
        ->paginate(9);
        
        return view("Frontend.Fact.index")->with($data);
    }
}

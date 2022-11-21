<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Quote_model;
class Quote_front extends Controller
{
    public function index(){
        $data['quotes'] = Quote_model::where("is_delete",0)
        ->where("quote_status",1)
        ->latest()
        ->paginate(9);
        return view("Frontend.Quote.index")->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function ajaxRequest(){
        return view('ajaxRequest');
    }

    public function ajaxRequestPost(Request $request){
        $input = $request->all();
        return response()->json(['success'=>'gost simple ajax ']);
    }
}
